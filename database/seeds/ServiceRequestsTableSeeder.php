<?php

use Illuminate\Database\Seeder;

class ServiceRequestsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //we at least one city for seeding
        \App\Models\CityArea::firstOrCreate(['city_id' => 1]);

        $services = \App\Models\Service::with( 'questions')->get();
        foreach ($services as $service)
        {
            for ($i = 0; $i < rand(2,5); $i++)
            {
                $serviceRequest = \App\Models\ServiceRequest::create([
                    'service_id' => $service->id,
                    'user_id' => array_random([null, rand(1, \App\Models\User::count())]),
                    'city_area_id' => rand(1, \App\Models\CityArea::count())
                ]);

                foreach ($service->questions as $q)
                {
                    $answers = array();
                    if($q->type == \App\Models\ServiceQuestion::TYPE_BOOLEAN)
                        $answers[] = \App\Models\ServiceRequestAnswerBoolean::create(['answer' => array_random([true, false])]);
                    else if($q->type == \App\Models\ServiceQuestion::TYPE_TEXT)
                        $answers[] = \App\Models\ServiceRequestAnswerText::create(['answer' => str_random()]);
                    else if($q->type == \App\Models\ServiceQuestion::TYPE_TEXT_MULTILINE)
                        $answers[] = \App\Models\ServiceRequestAnswerTextMultiline::create(['answer' => str_random()]);
                    else if($q->type == \App\Models\ServiceQuestion::TYPE_SELECT)
                        $answers[] = \App\Models\ServiceRequestAnswerChoice::create(['choice_id' => $q->choices->random()->id]);
                    else if($q->type == \App\Models\ServiceQuestion::TYPE_SELECT_MULTIPLE)
                    {
                        foreach ($q->choices->random(rand(1, $q->choices->count())) as $c)
                            $answers[] = \App\Models\ServiceRequestAnswerChoice::create(['choice_id' => $c->id]);
                    }

                    foreach($answers as $answer){
                        $serviceRequestAnswer = \App\Models\ServiceRequestAnswer::create([
                            'request_id' => $serviceRequest->id,
                            'question_id' => $q->id,
                            'answer_id' => $answer->id,
                            'answer_type' => get_class($answer)
                        ]);
                    }
                }
            }
        }
    }
}
