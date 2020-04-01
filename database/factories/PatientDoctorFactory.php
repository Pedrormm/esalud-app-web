<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\PatientDoctor;
use Faker\Generator as Faker;

$factory->define(PatientDoctor::class, function (Faker $faker) {

    return [
        'user_id_doctor' => $faker->word,
        'user_id_patient' => $faker->word,
        'deleted_at' => $faker->date('Y-m-d H:i:s'),
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
