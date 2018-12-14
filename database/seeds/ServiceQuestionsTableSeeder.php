<?php

use Illuminate\Database\Seeder;
use App\Models\ServiceQuestionValidationRule;

class ServiceQuestionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $questions = [
            [
                'name' => 'guest.name',
                'question' => 'Whats your name?',
                'type' => \App\Models\ServiceQuestion::TYPE_TEXT,
                'is_locked' => true
            ],
            [
                'name' => 'guest.email',
                'question' => 'Whats your email?',
                'type' => \App\Models\ServiceQuestion::TYPE_TEXT,
                'is_locked' => true
            ],
            [
                'name' => 'guest.phone',
                'question' => 'Whats your phone?',
                'type' => \App\Models\ServiceQuestion::TYPE_TEXT,
                'is_locked' => true
            ],
        ];

        foreach ($questions as $q) {
            $check = \App\Models\ServiceQuestion::where('name', $q['name'])
                ->where('type', $q['type'])
                ->first();
            if (is_null($check)) {
                $question = \App\Models\ServiceQuestion::create($q);
                if($q['name'] == 'guest.name')
                {
                    $question->rules()->sync([
                        ServiceQuestionValidationRule::where('rule', ServiceQuestionValidationRule::REQUIRED)->first()->id => ['value' => null],
                        ServiceQuestionValidationRule::where('rule', ServiceQuestionValidationRule::AUTH_GUEST)->first()->id => ['value' => null],
                        ServiceQuestionValidationRule::where('rule', ServiceQuestionValidationRule::TEXT_LENGTH_MIN)->first()->id => ['value' => 3],
                        ServiceQuestionValidationRule::where('rule', ServiceQuestionValidationRule::TEXT_LENGTH_MAX)->first()->id => ['value' => 191],
                    ]);
                }
                else if($q['name'] == 'guest.email')
                {
                    $question->rules()->sync([
                        ServiceQuestionValidationRule::where('rule', ServiceQuestionValidationRule::REQUIRED)->first()->id => ['value' => null],
                        ServiceQuestionValidationRule::where('rule', ServiceQuestionValidationRule::AUTH_GUEST)->first()->id => ['value' => null],
                        ServiceQuestionValidationRule::where('rule', ServiceQuestionValidationRule::TEXT_EMAIL)->first()->id => ['value' => null],
                    ]);
                }
                else if($q['name'] == 'guest.phone')
                {
                    $question->rules()->sync([
                        ServiceQuestionValidationRule::where('rule', ServiceQuestionValidationRule::REQUIRED)->first()->id => ['value' => null],
                        ServiceQuestionValidationRule::where('rule', ServiceQuestionValidationRule::AUTH_GUEST)->first()->id => ['value' => null],
                        ServiceQuestionValidationRule::where('rule', ServiceQuestionValidationRule::TEXT_PHONE)->first()->id => ['value' => null],
                    ]);
                }
            }
        }

        if(app()->environment(['local', 'staging'])) {
            $questions = factory(App\Models\ServiceQuestion::class, 50)
                ->create()
                ->each(function ($q) {
                    if($q->type == \App\Models\ServiceQuestion::TYPE_SELECT ||
                        $q->type == \App\Models\ServiceQuestion::TYPE_SELECT_MULTIPLE)
                    {
                        $choices = factory(App\Models\ServiceQuestionChoices::class, rand(1,7))
                            ->create(['question_id' => $q->id])
                            ->each(function ($c) {});
                    }
                });
        }
    }
}
