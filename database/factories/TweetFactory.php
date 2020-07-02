<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Tweet;
use Faker\Generator as Faker;

$factory->define(Tweet::class, function (Faker $faker) {
    return [
        'user_id' => factory(App\User::class),
        'body' => $faker->sentence
    ];
});
