<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\WarningRead;
use Faker\Generator as Faker;

$factory->define(WarningRead::class, function (Faker $faker) {

    return [
        'user_id' => $faker->word,
        'warning_id' => $faker->word,
        'deleted_at' => $faker->date('Y-m-d H:i:s'),
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
