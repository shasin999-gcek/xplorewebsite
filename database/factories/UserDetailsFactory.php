<?php

use Faker\Generator as Faker;

$factory->define(App\UserDetails::class, function (Faker $faker) {
    $college_ids = array();
    for($i = 1; $i <= 50; $i++) {
        array_push($college_ids, $i);
    }

    return [
        'user_id' => function () {
            return factory(App\User::class)->create()->id;
        },
        'college_id' => $faker->randomElement($college_ids),
        'branch' => $faker->randomElement(array('CSE', 'ECE', 'EEE', 'ME', 'CE')),
        'semester' => $faker->randomElement(array('S1', 'S2', 'S3', 'S4', 'S5', 'S6', 'S7', 'S8')),
        'mobile_number' => $faker->phoneNumber
    ];
});
