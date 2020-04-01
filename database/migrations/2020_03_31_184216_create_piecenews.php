<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePiecenews extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('piecenews', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title', 200)->nullable()->comment('Título de la noticia');
            $table->longText('content')->nullable()->comment('Contenido de la noticia');
            $table->date('date')->comment('Fecha de la noticia');
            $table->softDeletes();
            $table->timestamps();
        });

        Artisan::call('db:seed', [
            '--class' => PiecenewsTableSeeder::class
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('piecenews');
    }
}
