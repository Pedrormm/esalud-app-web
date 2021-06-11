<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppointmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('appointments', function (Blueprint $table) {
            $table->bigIncrements('id');
            
            $table->unsignedBigInteger('user_id_patient')->comment('FK(users.id). Paciente cita');;
            $table->foreign('user_id_patient')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('user_id_creator')->comment('FK(users.id). Creador de citas');
            $table->foreign('user_id_creator')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('user_id_doctor')->comment('FK(users.id). Doctor asignado de cita');
            $table->foreign('user_id_doctor')->references('id')->on('users')->onDelete('cascade');
            $table->datetime('dt_appointment')->comment('Fecha de inicio de la cita');
            $table->integer('appointment_minutes_duration')->nullable()->default(20)->comment('Tiempo de cada cita en minutos');
            $table->smallInteger('checked')->comment('0=Pendiente;1=Aceptada;2=Rechazada');
            $table->smallInteger('accomplished')->comment('0=No cumplido;1=Cumplido');
            $table->text('comments')->nullable()->comment('Comentarios del doctor');
            $table->text('user_comment')->nullable()->comment('Motivo de no asistancia (denegado)');
            $table->softDeletes();
            $table->timestamps();
        });
    }
    
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('appointments');
    }
}
