<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Note;
use Faker\Generator as Faker;

$factory->define(Note::class, function (Faker $faker) {

    return [
        'user_id' => $faker->word,
        'text' => $faker->text,
        'event' => $faker->word,
        'visible' => $faker->word,
        'deleted_at' => $faker->date('Y-m-d H:i:s'),
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
