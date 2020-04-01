<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Staff;
use Faker\Generator as Faker;

$factory->define(Staff::class, function (Faker $faker) {

    return [
        'historic' => $faker->word,
        'user_id' => $faker->word,
        'branch' => $faker->word,
        'shift' => $faker->word,
        'office' => $faker->word,
        'room' => $faker->word,
        'h_phone' => $faker->word,
        'deleted_at' => $faker->date('Y-m-d H:i:s'),
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
