<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Order;
use Faker\Generator as Faker;

$factory->define(Order::class, function (Faker $faker) {
    return [
        'user_id' => $faker->numberBetween(1, 10),
        'price' => $faker->numberBetween(1, 100),
        'status' => $faker->numberBetween(1, 4),
        'address' => 'Viet Nam',
    ];
});
