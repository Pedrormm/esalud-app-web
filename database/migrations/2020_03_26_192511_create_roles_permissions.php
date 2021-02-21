<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRolesPermissions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roles_permissions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->smallInteger('role_id')->unsigned()->comment('Rol asociado');
            $table->bigInteger('permission_id')->unsigned()->comment('Permiso asociado');
            $table->integer('activated')->unsigned()->comment('Tipo de permiso.0:No activado/1:Activado');
            // $table->string('value_name', 100)->comment('Nombre del tipo de permiso');
            $table->softDeletes();
            // $table->timestamps();     
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP')); 
        });

        // Artisan::call('db:seed', [
        //     '--class' => RolesPermissionsTableSeeder::class
        // ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('roles_permissions');
    }
}
