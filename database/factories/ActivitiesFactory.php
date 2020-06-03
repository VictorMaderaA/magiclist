<?php

/** @var Factory $factory */

use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

$factory->define(\App\Models\Activities::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'description' => $faker->realText(),
        'list_id' => function () use ($faker) {
            if($faker->boolean){
                return \App\Models\Lists::all()->random()->id;
            }
            return \factory(\App\Models\Lists::class)->create()->id;
        }
    ];
});
