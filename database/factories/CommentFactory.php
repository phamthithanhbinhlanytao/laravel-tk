<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Comment;
use Faker\Generator as Faker;

$factory->define(Comment::class, function (Faker $faker) {
    return [
        'content' => $faker->text(100),
        'product_id' => $faker->numberBetween(1, 10),
        'user_id' => $faker->numberBetween(1, 10),
        'parent_id' => $faker->numberBetween(1, 10),
    ];
});
