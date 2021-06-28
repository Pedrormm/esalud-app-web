<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeyToPatientsDoctors extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('patients_doctors', function (Blueprint $table) {
            $table->foreign('user_id_patient')->references('id')->on('users')
            ->onDelete('cascade')->onUpdate('cascade'); 
            $table->foreign('user_id_doctor')->references('id')->on('users')
            ->onDelete('cascade')->onUpdate('cascade'); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('patients_doctors', function (Blueprint $table) {
            $table->dropForeign(['user_id_patient']);
            $table->dropForeign(['user_id_doctor']);
        });
    }
}
