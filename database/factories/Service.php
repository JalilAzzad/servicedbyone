<?php

use Faker\Generator as Faker;

$factory->define(\App\Models\Service::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
        'slug' => function (array $modal) {
            return str_slug($modal['name']);
        },
        'description' => $faker->realText(500),
//        'location_type' => array_random([
//            \App\Models\Service::LOCATION_TYPE_ALL,
//            \App\Models\Service::LOCATION_TYPE_IN,
//            \App\Models\Service::LOCATION_TYPE_VIRTUAL,
//            \App\Models\Service::LOCATION_TYPE_EXCEPT,
//        ]),
    ];
});
