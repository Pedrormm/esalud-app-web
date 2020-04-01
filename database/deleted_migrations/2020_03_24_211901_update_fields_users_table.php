<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateFieldsUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('address', 200)->nullable()->comment('Dirección del usuario')->after('lastname');
            $table->string('city', 200)->nullable()->comment('Dirección del usuario')->after('address');
            $table->integer('zipcode')->nullable()->comment('Dirección del usuario')->after('city');
            $table->string('country', 20)->nullable()->comment('Dirección del usuario')->after('zipcode');
            $table->string('email', 100)->nullable()->comment('Dirección del usuario')->after('country');
            $table->string('phone', 15)->nullable()->comment('Dirección del usuario')->after('email');



            

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
            //
        });
    }
}
