<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\ProductUserRating;
use Faker\Generator as Faker;

$factory->define(ProductUserRating::class, function (Faker $faker) {
    return [
        'product_id' => $faker->numberBetween(1, 10),
        'user_id' => $faker->numberBetween(1, 10),
        'rating_point' => $faker->numberBetween(1, 5),
        'content' => $faker->text(),
    ];
});
