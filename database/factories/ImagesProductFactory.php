<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\ImageProduct;
use Faker\Generator as Faker;

$factory->define(ImageProduct::class, function (Faker $faker) {
    return [
        'product_id' => $faker->numberBetween(1, 4),
        'image' => 'picture-'.$faker->numberBetween(1, 4).'.jpg',
    ];
});
