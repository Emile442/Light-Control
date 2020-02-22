<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Light;
use Faker\Generator as Faker;

$factory->define(Light::class, function (Faker $faker) {
    return [
        'name' => $faker->firstName,
        'networkId' => $faker->numberBetween(0, 50)
    ];
});
