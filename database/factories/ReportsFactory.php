<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Reports;
use Faker\Generator as Faker;

$factory->define(Reports::class, function (Faker $faker) {

    return [
        'event_id' => $faker->word,
        'report' => $faker->text,
        'absence' => $faker->word,
        'deleted_at' => $faker->date('Y-m-d H:i:s'),
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
