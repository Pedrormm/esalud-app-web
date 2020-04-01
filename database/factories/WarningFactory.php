<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Warning;
use Faker\Generator as Faker;

$factory->define(Warning::class, function (Faker $faker) {

    return [
        'user_id_creator' => $faker->word,
        'user_id_patient' => $faker->word,
        'text' => $faker->text,
        'scope' => $faker->word,
        'deleted_at' => $faker->date('Y-m-d H:i:s'),
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
