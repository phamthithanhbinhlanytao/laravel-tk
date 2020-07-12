<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'picture' => 'image.jpg',
        'description' => $faker->text(),
        'price' => $faker->numberBetween(1, 50),
        'rating' => $faker->numberBetween(1, 5),
        'amount' => $faker->numberBetween(1, 50),
        'status' => $faker->numberBetween(0, 1),
        'category_id' => $faker->numberBetween(1, 10),
    ];
});
