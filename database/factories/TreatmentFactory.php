<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Treatment;
use Faker\Generator as Faker;

$factory->define(Treatment::class, function (Faker $faker) {

    return [
        'user_id_patient' => $faker->word,
        'user_id_doctor' => $faker->word,
        'type_medicine_id' => $faker->word,
        'medicine_administration_id' => $faker->word,
        'description' => $faker->text,
        'treatment_starting_date' => $faker->date('Y-m-d'),
        'treatment_end_date' => $faker->date('Y-m-d'),
        'deleted_at' => $faker->date('Y-m-d H:i:s'),
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
