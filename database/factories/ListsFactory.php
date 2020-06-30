<?php

/** @var Factory $factory */

use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

$factory->define(\App\Models\Lists::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'user_id' => function () use ($faker) {
            if($faker->boolean){
                return \App\User::all()->random()->id;
            }
            return \factory(\App\User::class)->create()->id;
        },
        'description' => function () use ($faker) {
            if($faker->boolean){
                return $faker->realText();
            }
            return '<p></p>';
        },
        'todo' => $faker->boolean,
        'private' => $faker->boolean,
    ];
});
