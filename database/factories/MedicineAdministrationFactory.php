<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\MedicineAdministration;
use Faker\Generator as Faker;

$factory->define(MedicineAdministration::class, function (Faker $faker) {

    return [
        'name' => $faker->text,
        'deleted_at' => $faker->date('Y-m-d H:i:s'),
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
