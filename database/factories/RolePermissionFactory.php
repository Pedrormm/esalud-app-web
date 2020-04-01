<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\RolePermission;
use Faker\Generator as Faker;

$factory->define(RolePermission::class, function (Faker $faker) {

    return [
        'role_id' => $faker->word,
        'permission_id' => $faker->word,
        'value' => $faker->randomDigitNotNull,
        'value_name' => $faker->word,
        'deleted_at' => $faker->date('Y-m-d H:i:s'),
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
