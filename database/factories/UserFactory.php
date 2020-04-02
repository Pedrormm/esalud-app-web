<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\User;
use Faker\Generator as Faker;

$factory->define(User::class, function (Faker $faker) {

    return [
        'dni' => $faker->word,
        'password' => $faker->word,
        'name' => $faker->word,
        'lastname' => $faker->word,
        'address' => $faker->word,
        'city' => $faker->word,
        'country' => $faker->word,
        'zipcode' => $faker->randomDigitNotNull,
        'email' => $faker->word,
        'phone' => $faker->word,
        'birthdate' => $faker->word,
        'avatar' => $faker->word,
        'sex' => $faker->word,
        'blood' => $faker->word,
        'role_id' => $faker->word,
        'remember_token' => $faker->word,
        'deleted_at' => $faker->date('Y-m-d H:i:s'),
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
