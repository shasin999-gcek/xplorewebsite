<?php

use Faker\Generator as Faker;

$factory->define(App\CollegeList::class, function (Faker $faker) {
    return [
        'college_name' => $faker->company
    ];
});
