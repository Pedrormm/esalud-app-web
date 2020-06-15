<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMessages extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user_id_from')->unsigned()->comment('Emisor del mensaje');
            $table->bigInteger('user_id_to')->unsigned()->comment('Receptor del mensaje');
            $table->longText('message')->nullable()->comment('Texto del mensaje');
            $table->boolean('read')->nullable()->default(false)->comment('Mensaje leído');
            $table->softDeletes();
            $table->timestamps();
        });

        Artisan::call('db:seed', [
            '--class' => MessagesTableSeeder::class
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('messages');
    }
}
