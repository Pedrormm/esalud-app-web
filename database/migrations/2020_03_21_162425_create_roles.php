<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->smallIncrements('id');
            $table->string('name', 250)->nullable()->index()->comment('Role name');
            $table->unsignedBigInteger('user_id_creator')->comment('Creator Id');
            $table->unsignedSmallInteger('delible')->nullable()->default(0)->comment('If the value is 1 the role cannot be deleted');
            $table->softDeletes();
            $table->timestamps();
        });

        // Artisan::call('db:seed', [
        //     '--class' => RolesTableSeeder::class
        // ]);
    //DB::statement('SET FOREIGN_KEY_CHECKS=0');

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('roles');
    }
}
