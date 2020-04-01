<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Medicine;
use Faker\Generator as Faker;

$factory->define(Medicine::class, function (Faker $faker) {

    return [
        'user_id_patient' => $faker->word,
        'user_id_doctor' => $faker->word,
        'medicine' => $faker->word,
        'interval' => $faker->word,
        'stop' => $faker->text,
        'stop_user' => $faker->word,
        'deleted_at' => $faker->date('Y-m-d H:i:s'),
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
