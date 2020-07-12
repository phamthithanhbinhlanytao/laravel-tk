<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(User::class, function (Faker $faker) {
    return [
        'email' => $faker->unique()->safeEmail,
        'password' => Hash::make(12345678),
        'fullname' => $faker->name,
        'birthday' => $faker->date(),
        'address' => 'Viet Nam',
        'phone' => $faker->phoneNumber,
        'avatar' => 'avatar.jpg',
        'role' => 0,
    ];
});
