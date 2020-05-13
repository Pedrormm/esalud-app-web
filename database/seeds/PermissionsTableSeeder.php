<?php

use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('permissions')->delete();
        
        \DB::table('permissions')->insert(array (
            0 => 
            array (
                'id' => 1,
                'flag_meaning' => 'LOGIN',
                'default_permission' => 1,
                'permission_name' => 'READ',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ),
            1 => 
            array (
                'id' => 2,
                'flag_meaning' => 'PROFILE',
                'default_permission' => 2,
                'permission_name' => 'READ_AND_WRITE',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ),
            2 => 
            array (
                'id' => 3,
                'flag_meaning' => 'NEWS',
                'default_permission' => 1,
                'permission_name' => 'READ',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ),
            3 => 
            array (
                'id' => 4,
                'flag_meaning' => 'ROLE_ASSIGNMENT',
                'default_permission' => 0,
                'permission_name' => 'NONE',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ),
        ));
        
        
    }
}