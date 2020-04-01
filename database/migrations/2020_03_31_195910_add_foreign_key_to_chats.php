<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeyToChats extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('chats', function (Blueprint $table) {
            $table->foreign('user_id_user_A')->references('id')->on('users')
            ->onDelete('cascade')->onUpdate('cascade'); 
            $table->foreign('user_id_user_B')->references('id')->on('users')
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
        Schema::table('chats', function (Blueprint $table) {
            $table->dropForeign(['user_id_user_A']);
            $table->dropForeign(['user_id_user_B']);
        });
    }
}
