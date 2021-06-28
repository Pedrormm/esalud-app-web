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
            $table->unsignedBigInteger('user_id_patient')->comment('FK(users.id). Asigned patient to current appointment');;
            $table->foreign('user_id_patient')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('user_id_creator')->comment('FK(users.id). Appointment creator');
            $table->foreign('user_id_creator')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('user_id_doctor')->comment('FK(users.id). Asigned doctor to current appointment');
            $table->foreign('user_id_doctor')->references('id')->on('users')->onDelete('cascade');
            $table->datetime('dt_appointment')->comment('Appointment start date');
            $table->integer('appointment_minutes_duration')->nullable()->default(30)->comment('Appointment time in minutes');
            $table->smallInteger('checked')->comment('0=Pending;1=Accepted;2=Denied');
            $table->smallInteger('accomplished')->comment('0=No accomplished;1=Accomplished');
            $table->text('comments')->nullable()->comment('Doctor comments');
            $table->text('user_comment')->nullable()->comment('Reason for non-attendance (denied)');
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
