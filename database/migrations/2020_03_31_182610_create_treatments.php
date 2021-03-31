<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use DB as DBS;
use Carbon\Carbon;

class CreateTreatments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('Treatments', function (Blueprint $table) {
            $expire_date = Carbon::now()->addDays(7);
            $table->bigIncrements('id');
            $table->bigInteger('user_id_patient')->unsigned()->comment('Paciente asociado');
            $table->bigInteger('user_id_doctor')->unsigned()->comment('Doctor encargado');
            $table->bigInteger('type_medicine_id')->unsigned()->nullable()->comment('Tipo de medicina');
            $table->bigInteger('medicine_administration_id')->nullable()->unsigned()->comment('Modo de administración del fármaco');
            $table->string('description',1000)->nullable()->index()->default(0)->comment('Descripción de tratamiento');
            $table->date('treatment_starting_date')->nullable()->useCurrent()->comment('Fecha de inicio del tratamiento');
            $table->date('treatment_end_date')->nullable()->default($expire_date)->comment('Fecha de finalización del tratamiento, default 1 semana');
            $table->softDeletes();
            $table->timestamps();
        });

        // Artisan::call('db:seed', [
        //     '--class' => MedicinesTableSeeder::class
        // ]);

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
