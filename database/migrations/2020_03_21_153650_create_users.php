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
            $table->bigIncrements('id');
            $table->string('dni', 20)->unique()->index()->comment('DNI');
            $table->string('password', 250)->comment('Contraseña del usuario');
            $table->string('name', 250)->nullable()->index()->comment('Nombre del usuario');
            $table->string('lastname', 250)->nullable()->index()->comment('Apellido del usuario');
            $table->string('address', 200)->nullable()->comment('Dirección del usuario');
            $table->string('city', 200)->nullable()->comment('Dirección del usuario');
            $table->string('country', 20)->nullable()->comment('Dirección del usuario');
            $table->integer('zipcode')->nullable()->comment('Dirección del usuario');
            $table->string('email', 100)->index()->nullable()->comment('Dirección del usuario');
            $table->string('phone', 15)->nullable()->comment('Dirección del usuario');
            $table->date('birthdate')->comment('Fecha de nacimiento del usuario');
            $table->string('avatar', 250)->nullable()->comment('Avatar del usuario');
            $table->enum('sex',['male','female'])->index()->comment('Genéro del usuario');
            $table->enum('blood',['0-','0+','A-','A+','B-','B+','AB-','AB+'])->index()->comment('Grupo sanguíneo del usuario');
            $table->unsignedSmallInteger('role_id')->nullable()->comment('Rol de usuario');
            $table->string('remember_token', 500)->comment('Recordar contraseña');
            $table->softDeletes();
            $table->timestamps();
        });

        Artisan::call('db:seed', [
            '--class' => UsersTableSeeder::class
        ]);
        // $this->call(UsersTableSeeder::class);
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
