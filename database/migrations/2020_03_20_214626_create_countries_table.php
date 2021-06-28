<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCountriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('countries', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned();
            $table->string('name', 150)->nullable()->comment('Name of the country');
            $table->string('short_name', 100)->nullable()->comment('Short name of the country');
            $table->string('long_name', 200)->nullable()->comment('Long name of the country');
            // $table->string('phone_prefix', 10)->nullable()->comment('Phone prefix of the country');
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
        Schema::dropIfExists('countries');
    }
}
