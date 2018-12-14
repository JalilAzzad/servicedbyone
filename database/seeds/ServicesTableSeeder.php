<?php

use Illuminate\Database\Seeder;

class ServicesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $services = factory(App\Models\Service::class, 50)
            ->create()
            ->each(function ($s) {
                $states_count = \App\Models\ServiceCategory::count();
                $categories_count = \App\Models\ServiceCategory::count();
                $questions_count = \App\Models\ServiceQuestion::count();

                for ($i = 0; $i < rand(5,15); $i++)
                {
                    $temp = rand(1, $states_count);
                    $s->states()->detach($temp);
                    $s->states()->attach($temp);
                    $temp = rand(1, $categories_count);
                    $s->categories()->detach($temp);
                    $s->categories()->attach($temp);
                    $temp = rand(1, $questions_count);
                    $s->questions()->detach($temp);
                    $s->questions()->attach($temp);
                }
            });
    }
}
