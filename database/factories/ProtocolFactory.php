<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Protocol;
use Faker\Generator as Faker;

$factory->define(Protocol::class, function (Faker $faker) {

    return [
        'user_id_creator' => $faker->word,
        'user_id_user' => $faker->word,
        'name' => $faker->text,
        'deleted_at' => $faker->date('Y-m-d H:i:s'),
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
