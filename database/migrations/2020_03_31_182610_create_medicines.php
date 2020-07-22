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
            // $table->smallInteger('treatment_status')->default('0')->comment('Estado del tratamiento - 0:Activo - 1:Finalizado');
            $table->enum('treatment_status',['active','ended'])->default('active')->comment('Estado del tratamiento');
            $table->date('treatment_date')->nullable()->comment('Fecha de finalización del tratamiento');
            $table->unsignedSmallInteger('type_medicine_id')->nullable();
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
