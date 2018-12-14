<?php

use Faker\Generator as Faker;

$factory->define(\App\Models\ServiceCategory::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
        'slug' => function (array $modal) {
            return str_slug($modal['name']);
        },
    ];
});
