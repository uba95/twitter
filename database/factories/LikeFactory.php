<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Like;
use Faker\Generator as Faker;

$factory->define(Like::class, function (Faker $faker) {
    return [
        'user_id' => factory(App\User::class),
        'tweet_id' => factory(App\Tweet::class),
        'liked' => $faker->boolean(rand(20, 80)),
    ];
});
