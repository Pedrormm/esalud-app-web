<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMedicalSpecialities extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medical_specialities', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 100)->comment('Speciality name');
            $table->enum('speciality_type',['doctor','helper'])->comment('Speciality name');
            $table->unsignedBigInteger('role_id')->nullable()->comment('Specility kind, associated to an user role');
            $table->softDeletes();
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
        });

        // Artisan::call('db:seed', [
        //     '--class' => MedicalSpecialitiesTableSeeder::class
        // ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('medical_specialities');
    }
}
