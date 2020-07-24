<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersInvitations extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_invitations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('dni', 20)->unique()->index()->comment('DNI');
            $table->string('email', 100)->nullable()->index()->comment('Dirección del usuario');
            $table->string('verification_token', 250)->nullable()->index()->comment('Token de verificación del email');
            $table->date('expiration_date')->nullable()->comment('Fecha de expiración del email');
            $table->integer('times_sent')->default('0')->comment('Número de veces que fue enviada la solicitud');
            $table->unsignedSmallInteger('role_id')->nullable()->comment('Rol de usuario');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users_invitations');
    }
}
