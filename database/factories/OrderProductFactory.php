<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\OrderProduct;
use Faker\Generator as Faker;

$factory->define(OrderProduct::class, function (Faker $faker) {
    return [
        'order_id' => $faker->numberBetween(1, 10),
        'product_id' => $faker->numberBetween(1, 10),
        'amount' => 10
    ];
});
