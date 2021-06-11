<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;


class CreateStaff extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('staff', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('historic', 150)->nullable();
            $table->bigInteger('user_id')->unsigned();
            $table->bigInteger('branch_id')->unsigned();
            // $table->string('shift', 100)->nullable();
            $table->string('office', 100)->nullable();
            $table->string('room', 100)->nullable();
            $table->string('h_phone', 100)->nullable();
            // $table->boolean('available')->default('true');
            $table->softDeletes();
            $table->timestamps();
        });

        // Artisan::call('db:seed', [
        //     '--class' => StaffTableSeeder::class
        // ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        Schema::dropIfExists('staff');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');

    }
}
