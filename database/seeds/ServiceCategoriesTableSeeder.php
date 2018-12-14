<?php

use Illuminate\Database\Seeder;

class ServiceCategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            'Packing & Moving',
            'HVAC',
            'Carpenter',
            'Cleaning',
            'Gardening',
            'Painter & Decorator',
        ];

        foreach ($categories as $category)
        {
            $category = \App\Models\ServiceCategory::create([
                'name' => $category,
                'slug' => str_slug($category)
            ]);
        }
    }
}
