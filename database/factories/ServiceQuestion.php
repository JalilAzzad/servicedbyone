<?php

use Faker\Generator as Faker;

$factory->define(\App\Models\ServiceQuestion::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
        'question' => $faker->sentence,
        'type' => array_random([
            \App\Models\ServiceQuestion::TYPE_BOOLEAN,
            \App\Models\ServiceQuestion::TYPE_TEXT,
            \App\Models\ServiceQuestion::TYPE_TEXT_MULTILINE,
            \App\Models\ServiceQuestion::TYPE_SELECT,
            \App\Models\ServiceQuestion::TYPE_SELECT_MULTIPLE,
            \App\Models\ServiceQuestion::TYPE_DATE,
            \App\Models\ServiceQuestion::TYPE_TIME,
            \App\Models\ServiceQuestion::TYPE_DATE_TIME,
            \App\Models\ServiceQuestion::TYPE_FILE,
            \App\Models\ServiceQuestion::TYPE_FILE_MULTIPLE,
        ]),
    ];
});
