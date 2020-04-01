<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Chat;
use Faker\Generator as Faker;

$factory->define(Chat::class, function (Faker $faker) {

    return [
        'user_id_user_A' => $faker->word,
        'user_id_user_B' => $faker->word,
        'deleted_at' => $faker->date('Y-m-d H:i:s'),
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
