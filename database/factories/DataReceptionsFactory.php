<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\DataReception;
use Faker\Generator as Faker;

$factory->define(DataReception::class, function (Faker $faker) {
    return [
        'device_id' => 123456,
        'topic' => $faker->randomElement(['temp1', 'temp1_derivate', 'temp1_performance']),
        'value' => rand(0,30),
        'created_at' => $faker->dateTimeBetween($startDate = 'yesterday', $endDate = 'now', $timezone = null),
    ];
});
