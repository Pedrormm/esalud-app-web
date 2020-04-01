<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\PieceNew;
use Faker\Generator as Faker;

$factory->define(PieceNew::class, function (Faker $faker) {

    return [
        'title' => $faker->word,
        'content' => $faker->text,
        'date' => $faker->word,
        'deleted_at' => $faker->date('Y-m-d H:i:s'),
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
