<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Permissions;
use Faker\Generator as Faker;

$factory->define(Permissions::class, function (Faker $faker) {

    return [
        'flag_meaning' => $faker->word,
        'default_permission' => $faker->word,
        'permission_name' => $faker->word,
        'deleted_at' => $faker->date('Y-m-d H:i:s'),
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
