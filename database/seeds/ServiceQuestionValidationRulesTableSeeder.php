<?php

use Illuminate\Database\Seeder;

class ServiceQuestionValidationRulesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $rules = [
            [
                'rule' => \App\Models\ServiceQuestionValidationRule::REQUIRED,
                'laravel_rule' => 'required',
                'html_rule' => 'required'
            ],
            [
                'rule' => \App\Models\ServiceQuestionValidationRule::AUTH_REQUIRED,
                'laravel_rule' => null,
                'html_rule' => null
            ],
            [
                'rule' => \App\Models\ServiceQuestionValidationRule::AUTH_GUEST,
                'laravel_rule' => null,
                'html_rule' => null
            ],
            [
                'rule' => \App\Models\ServiceQuestionValidationRule::AUTH_ANY,
                'laravel_rule' => null,
                'html_rule' => null
            ],
            [
                'rule' => \App\Models\ServiceQuestionValidationRule::TEXT_LENGTH_MIN,
                'laravel_rule' => 'min:$value',
                'html_rule' => 'min:$value',
            ],
            [
                'rule' => \App\Models\ServiceQuestionValidationRule::TEXT_LENGTH_MAX,
                'laravel_rule' => 'max:$value',
                'html_rule' => 'max:$value',
            ],
            [
                'rule' => \App\Models\ServiceQuestionValidationRule::TEXT_EMAIL,
                'laravel_rule' => 'email',
                'html_rule' => null,
            ],
            [
                'rule' => \App\Models\ServiceQuestionValidationRule::TEXT_PHONE,
                'laravel_rule' => \App\Rules\Phone::class,
                'html_rule' => null,
                'is_custom_laravel_rule' => true
            ],
            [
                'rule' => \App\Models\ServiceQuestionValidationRule::FILE_SIZE_MIN,
                'laravel_rule' => 'min:$value',
                'html_rule' => 'min:$value',
            ],
            [
                'rule' => \App\Models\ServiceQuestionValidationRule::FILE_SIZE_MAX,
                'laravel_rule' => 'max:$value',
                'html_rule' => 'max:$value',
            ],
            [
                'rule' => \App\Models\ServiceQuestionValidationRule::FILE_TYPE_IMAGE,
                'laravel_rule' => 'image',
                'html_rule' => null
            ],
            [
                'rule' => \App\Models\ServiceQuestionValidationRule::FILE_TYPE_VIDEO,
                'laravel_rule' => 'mimetypes:video/avi,video/mpeg,video/quicktime',
                'html_rule' => null
            ],
        ];

        foreach ($rules as $rule)
        {
            \App\Models\ServiceQuestionValidationRule::create($rule);
        }
    }
}
