<?php

use Faker\Generator as Faker;

$factory->define(App\Event::class, function (Faker $faker) {

    $event_name = $faker->text(10);

    return [
        'name' => $event_name,
        'slug' => str_slug($event_name),
        'description' => $faker->text(),
        'category_id' => rand(1, 7),
        'type' => $faker->randomElement(['Individual', 'Team']),
        'reg_fee' => $faker->numberBetween(100, 600),
        'f_price_money' => 6000,
        's_price_money' => 3000,
        't_price_money' => 1500,
        'poster_image_name' => 'event_posters/Ttsm4YjddjDnHbp7jlr508CAKQeDzCgZJ5965ZCI.jpeg'
    ];
});
