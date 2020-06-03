<?php

/** @var Factory $factory */

use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

$factory->define(MODEL::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
    ];
});
