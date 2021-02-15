<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnalytics extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('analytics', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->smallInteger('type')->comment('Tipo de análisis');
            $table->unsignedBigInteger('user_id_user')->comment('Id relacionado al tipo de usuario');
            $table->unsignedBigInteger('user_id_creator')->comment('Id relacionado al usuario creador');
            $table->unsignedBigInteger('analytic_result')->nullable()->comment('Resultado asociado a analytics_results');
            $table->longText('result')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });

        // Artisan::call('db:seed', [
        //     '--class' => AnalyticsTableSeeder::class
        // ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('analytics');
    }
}
