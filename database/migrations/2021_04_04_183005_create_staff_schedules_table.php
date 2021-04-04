<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStaffSchedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('staff_schedules', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('staff_id')->unsigned()->comment('Relación con el staff');
            $table->timeTz('starting_workday_time')->nullable()->comment('Hora de inicio de la jornada laboral');
            $table->timeTz('ending_workday_time')->nullable()->comment('Hora de fin de la jornada laboral');
            $table->integer('weekday')->nullable()->comment('Día de la semana de la jornada laboral');
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
        Schema::dropIfExists('staff_schedules');
    }
}
