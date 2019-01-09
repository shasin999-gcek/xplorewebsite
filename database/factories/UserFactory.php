<?php

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => '$2y$10$VJqzxaM0umU7FZjXWcIem.ROp3.13mjZhLIj6i7TBQ/mCtLm4bnfW', // $@170vexplore19@$
        'firebase_uid' => '1234',// secret
        'remember_token' => str_random(10),
    ];
});
