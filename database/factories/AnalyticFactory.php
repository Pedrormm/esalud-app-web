<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Analytic;
use Faker\Generator as Faker;

$factory->define(Analytic::class, function (Faker $faker) {

    return [
        'type' => $faker->word,
        'user_id_user' => $faker->word,
        'user_id_creator' => $faker->word,
        'analytic_result' => $faker->word,
        'result' => $faker->text,
        'deleted_at' => $faker->date('Y-m-d H:i:s'),
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
