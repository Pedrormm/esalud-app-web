<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Event;
use Faker\Generator as Faker;

$factory->define(Event::class, function (Faker $faker) {

    return [
        'user_id_patient' => $faker->word,
        'user_id_doctor' => $faker->word,
        'start' => $faker->word,
        'online' => $faker->word,
        'location' => $faker->word,
        'request' => $faker->word,
        'finished' => $faker->word,
        'deleted_at' => $faker->date('Y-m-d H:i:s'),
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
