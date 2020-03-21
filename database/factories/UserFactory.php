<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Domain\Entity\User;
use Faker\Generator as Faker;

$factory->define(User::class, function (Faker $faker) {
    return [
        'id' => $faker->randomDigit,
        'name' => $faker->name,
        'self_produce' => $faker->text,
        'birth_year' => $faker->year($max = 'now'),
        'birth_month' => $faker->month($max = 'now'),
        'birth_day' => $faker->dayOfMonth($max = 'now'),
        'follow' => $faker->randomDigit,
        'follower' => $faker->randomDigit,
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'password' => $faker->password,
        'remember_token' => Str::random(10),
    ];
});
