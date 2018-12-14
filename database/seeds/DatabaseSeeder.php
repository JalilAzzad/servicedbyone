<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RolesTableSeeder::class);
        $this->call(UsersTableSeeder::class);

        $this->call(ServiceCategoriesTableSeeder::class);
        $this->call(ServiceQuestionValidationRulesTableSeeder::class);
        $this->call(ServiceQuestionsTableSeeder::class);

        if(app()->environment(['local', 'staging'])) {
            $this->call(ServicesTableSeeder::class);
            $this->call(ServiceRequestsTableSeeder::class);
        }
    }
}
