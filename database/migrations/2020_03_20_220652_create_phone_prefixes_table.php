<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePhonePrefixesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('phone_prefixes', function (Blueprint $table) {
            // $table->id();
            $table->bigIncrements('id'); 
            $table->string('prefix', 10)->nullable()->comment('Phone prefix code number');
            $table->bigInteger('country_id')->unsigned()->comment('Associated country of the phone prefix');
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
        Schema::dropIfExists('phone_prefixes');
    }
}
