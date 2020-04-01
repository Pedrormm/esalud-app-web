<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class ChangeUsersOrderStatements extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function __construct()
    {
        DB::getDoctrineSchemaManager()->getDatabasePlatform()->registerDoctrineTypeMapping('enum', 'string');
    }

    public function up()
    {
        //Give the moving column a temporary name:
        Schema::table('users', function($table)
        {
            $table->renameColumn('dni', 'dni_old');
            $table->renameColumn('password', 'password_old');
            $table->renameColumn('remember_token', 'remember_token_old');

        });
    
        //Add a new column with the regular name:
        Schema::table('users', function(Blueprint $table)
        {
            $table->string('dni')->after('id');
            $table->string('password')->after('dni');
            $table->string('remember_token')->after('avatar');

        });
    
        //Copy the data across to the new column:
        DB::table('users')->update([
            'name' => DB::raw('dni_old'),   
            'name' => DB::raw('password_old'),   
            'name' => DB::raw('remember_token_old')   

        ]);
    
        //Remove the old column:
        Schema::table('users', function(Blueprint $table)
        {
            $table->dropColumn('dni_old');
            $table->dropColumn('password_old');
            $table->dropColumn('remember_token_old');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {

        });
    }
}
