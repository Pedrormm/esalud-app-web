<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeyToUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->foreign('country_id')->references('id')->on('countries')
            ->onDelete('cascade')->onUpdate('cascade');
            // $table->foreign('phone_prefix_id')->references('id')->on('phones_prefixes')
            // ->onDelete('cascade')->onUpdate('cascade'); 
            $table->foreign('role_id')->references('id')->on('roles')
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
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['country_id']);
            // $table->dropForeign(['phone_prefix_id']);
            $table->dropForeign(['role_id']);
        });
    }
}
