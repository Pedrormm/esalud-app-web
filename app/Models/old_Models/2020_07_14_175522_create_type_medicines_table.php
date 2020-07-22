<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTypeMedicinesTable_ extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::create('type_medicines', function (Blueprint $table) {
        //     $table->smallIncrements('id');
        //     $table->string('name');
        //     $table->timestamps();
        // });

        // Artisan::call('db:seed', [
        //     '--class' => TypeMedicineSeeder::class
        // ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Schema::dropIfExists('type_medicines');
    }
}
