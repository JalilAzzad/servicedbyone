<?php

use Faker\Generator as Faker;

$factory->define(\App\Models\ServiceQuestionChoices::class, function (Faker $faker) {
    return [
        'choice' => $faker->sentence,
    ];
});
