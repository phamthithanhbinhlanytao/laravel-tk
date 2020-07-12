<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Sale;
use Faker\Generator as Faker;

$factory->define(Sale::class, function (Faker $faker) {
    return [
        'product_id' => $faker->numberBetween(1, 10),
        'discount' => $faker->numberBetween(1, 90),
        'start_time' => '2020-06-10',
        'end_time' => $faker->date(now()),
    ];
});
