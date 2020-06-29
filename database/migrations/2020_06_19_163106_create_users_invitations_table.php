<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersInvitationsTable extends Migration
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
            $table->string('email', 100)->unique()->nullable()->index()->comment('Dirección del usuario');
            $table->string('verification_token', 250)->nullable()->index()->comment('Token de verificación del email');
            $table->date('expiration_date')->comment('Fecha de expiración del email');
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
