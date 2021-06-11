<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned();
            $table->string('dni', 100)->unique()->index()->comment('DNI');
            $table->string('password', 250)->comment('User password');
            $table->string('name', 250)->nullable()->index()->comment('User name');
            $table->string('lastname', 250)->nullable()->index()->comment('User lastname');
            $table->string('address', 200)->nullable()->comment('User address');
            $table->string('city', 200)->nullable()->comment('User city');
            $table->string('country', 100)->nullable()->comment('User country');
            $table->integer('zipcode')->nullable()->comment('User zipcode');
            $table->string('email', 200)->unique()->index()->comment('User email');
            $table->string('phone', 20)->nullable()->comment('User personal telephone number');
            $table->date('birthdate')->comment('User birthdate');
            $table->string('avatar', 250)->nullable()->comment('User avatar or photo');
            $table->enum('sex',['male','female'])->index()->comment('User gender');
            $table->enum('blood',['0-','0+','A-','A+','B-','B+','AB-','AB+'])->index()->comment('User blood group');
            $table->unsignedSmallInteger('role_id')->nullable()->comment('User role type');
            $table->string('remember_token', 500)->comment('Remember password token');
            $table->integer('news_number')->nullable()->default('5')->comment('Number of news that the user can see simultaneously');
            $table->boolean('has_spelling_checker')->default(false)->comment('If true activates the spelling checker in the site');
            $table->softDeletes();
            $table->timestamps();
        });

        // Artisan::call('db:seed', [
        //     '--class' => UsersTableSeeder::class
        // ]);
        // $this->call(UsersTableSeeder::class);
    //DB::statement('SET FOREIGN_KEY_CHECKS=0');

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
