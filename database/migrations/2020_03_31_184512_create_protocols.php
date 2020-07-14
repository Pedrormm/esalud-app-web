<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProtocols extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('protocols', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user_id_creator')->unsigned();
            $table->bigInteger('user_id_user')->unsigned();
            $table->longText('name')->nullable();
            $table->timestamp('starting_date')->useCurrent()->comment('Fecha de comienzo del protocolo');
            $table->timestamp('ending_date')->useCurrent()->comment('Fecha de finalización del protocolo');
            $table->softDeletes();
            $table->timestamps();
        });

        Artisan::call('db:seed', [
            '--class' => ProtocolsTableSeeder::class
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('protocols');
    }
}
