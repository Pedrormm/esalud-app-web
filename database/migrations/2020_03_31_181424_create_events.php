<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEvents extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user_id_patient')->unsigned()->comment('Paciente');
            $table->bigInteger('user_id_doctor')->unsigned()->comment('Doctor');
            $table->smallInteger('start')->nullable()->comment('Comenzado');
            $table->smallInteger('online')->nullable()->comment('Está online');
            $table->string('location', 100)->nullable()->comment('Localización');
            $table->string('request', 200)->nullable()->comment('Petición');
            $table->smallInteger('finished')->nullable()->comment('Finalizado');
            $table->softDeletes();
            $table->timestamps();
        });

        // Artisan::call('db:seed', [
        //     '--class' => EventsTableSeeder::class
        // ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('events');
    }
}
