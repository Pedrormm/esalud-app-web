<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
// use DB;
use DB as DBS;


class AddForeignKeyToTreatments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DBS::statement('SET FOREIGN_KEY_CHECKS=0;');


        Schema::table('treatments', function (Blueprint $table) {
            $table->foreign('user_id_patient')->references('id')->on('users')
            ->onDelete('cascade')->onUpdate('cascade'); 
            $table->foreign('user_id_doctor')->references('id')->on('users')
            ->onDelete('cascade')->onUpdate('cascade'); 
            $table->foreign('type_medicine_id')->references('id')->on('type_medicines')
            ->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('medicine_administration_id')->references('id')->on('medicines_administration')
            ->onDelete('cascade')->onUpdate('cascade');
        });

        // DBS::statement('SET FOREIGN_KEY_CHECKS=1;');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('treatments', function (Blueprint $table) {
            $table->dropForeign(['user_id_patient']);
            $table->dropForeign(['user_id_doctor']);
            $table->dropForeign(['type_medicine_id']);     
            $table->dropForeign(['medicine_administration_id']);                   
        });
    }
}
