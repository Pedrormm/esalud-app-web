<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePermissions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permissions', function (Blueprint $table) {
            $table->bigIncrements('id')->comment('ID de la vista a dar permisos');
            $table->string('flag_meaning', 100)->index()->comment('Nombre de la vista a dar permisos');
            $table->smallInteger('default_permission')->default(0)->index()->comment('Permiso por defecto de la vista: 0/1');
            // $table->string('permission_name', 100)->comment('Nombre del tipo de permiso');
            $table->softDeletes();
            $table->timestamps();
        });

        Artisan::call('db:seed', [
            '--class' => PermissionsTableSeeder::class
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('permissions');
    }
}
