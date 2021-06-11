<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePatients extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patients', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id')->comment('Id associated to user');
            $table->string('historic', 100)->unique()->comment('Patient historical number');
            $table->integer('height')->nullable()->comment('Patient height in cm');
            $table->double('weight')->nullable()->comment('Patient weight in kg');
            $table->softDeletes();
            $table->timestamps();
        });

        // Artisan::call('db:seed', [
        //     '--class' => PatientsTableSeeder::class
        // ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('patients');
    }
}
