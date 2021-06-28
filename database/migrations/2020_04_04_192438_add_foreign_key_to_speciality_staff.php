<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeyToSpecialityStaff extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('specialities_staff', function (Blueprint $table) {
            $table->foreign('staff_id')->references('id')->on('staff')
            ->onDelete('cascade')->onUpdate('cascade'); 
            $table->foreign('medical_speciality_id')->references('id')->on('medical_specialities')
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
        Schema::table('specialities_staff', function (Blueprint $table) {
            $table->dropForeign(['staff_id']);
            $table->dropForeign(['medical_speciality_id']);
        });
    }
}
