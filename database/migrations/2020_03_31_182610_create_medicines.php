<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMedicines extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medicines', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user_id_patient')->unsigned()->comment('Paciente');
            $table->bigInteger('user_id_doctor')->unsigned()->comment('Doctor');
            $table->bigInteger('medicine')->comment('Tipo de medicina');
            $table->string('interval', 200)->nullable();
            $table->longText('stop')->nullable();
            $table->bigInteger('stop_user')->default('0');
            $table->softDeletes();
            $table->timestamps();
        });

        Artisan::call('db:seed', [
            '--class' => MedicinesTableSeeder::class
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('medicines');
    }
}
