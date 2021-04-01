<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Route;
use Faker\Generator as Faker;

$factory->define(Route::class, function (Faker $faker) {

    return [
        'permission_id' => $faker->word,
        'name' => $faker->text,
        'deleted_at' => $faker->date('Y-m-d H:i:s'),
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
