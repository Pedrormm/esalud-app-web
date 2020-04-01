<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeyToCalls extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('calls', function (Blueprint $table) {
            $table->foreign('user_id_caller')->references('id')->on('users')
            ->onDelete('cascade')->onUpdate('cascade'); 
            $table->foreign('user_id_receptor')->references('id')->on('users')
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
        Schema::table('calls', function (Blueprint $table) {
            $table->dropForeign(['user_id_caller']);
            $table->dropForeign(['user_id_receptor']);
        });
    }
}
