<?php

use Illuminate\Database\Seeder;

class RolesPermissionsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('roles_permissions')->delete();
        
        \DB::table('roles_permissions')->insert(array (
            0 => 
            array (
                'id' => 1,
                'role_id' => 1,
                'permission_id' => 1,
                'value' => 1,
                'value_name' => 'READ',
                'created_at' => '2020-03-12 20:31:14',
                'updated_at' => '2020-03-12 20:31:14',
            ),
            1 => 
            array (
                'id' => 2,
                'role_id' => 1,
                'permission_id' => 2,
                'value' => 2,
                'value_name' => 'READ_AND_WRITE',
                'created_at' => '2020-03-12 20:31:14',
                'updated_at' => '2020-03-12 20:31:14',
            ),
            2 => 
            array (
                'id' => 3,
                'role_id' => 1,
                'permission_id' => 3,
                'value' => 2,
                'value_name' => 'READ_AND_WRITE',
                'created_at' => '2020-03-12 20:31:14',
                'updated_at' => '2020-03-12 20:31:14',
            ),
            3 => 
            array (
                'id' => 4,
                'role_id' => 1,
                'permission_id' => 4,
                'value' => 2,
                'value_name' => 'READ_AND_WRITE',
                'created_at' => '2020-03-12 20:31:14',
                'updated_at' => '2020-03-12 20:31:14',
            ),
            4 => 
            array (
                'id' => 5,
                'role_id' => 2,
                'permission_id' => 1,
                'value' => 1,
                'value_name' => 'READ',
                'created_at' => '2020-03-12 20:31:14',
                'updated_at' => '2020-03-12 20:31:14',
            ),
            5 => 
            array (
                'id' => 6,
                'role_id' => 2,
                'permission_id' => 2,
                'value' => 2,
                'value_name' => 'READ_AND_WRITE',
                'created_at' => '2020-03-12 20:31:14',
                'updated_at' => '2020-03-12 20:31:14',
            ),
            6 => 
            array (
                'id' => 7,
                'role_id' => 2,
                'permission_id' => 3,
                'value' => 0,
                'value_name' => 'NONE',
                'created_at' => '2020-03-12 20:31:14',
                'updated_at' => '2020-03-12 20:31:14',
            ),
            7 => 
            array (
                'id' => 8,
                'role_id' => 2,
                'permission_id' => 4,
                'value' => 1,
                'value_name' => 'READ',
                'created_at' => '2020-03-12 20:31:14',
                'updated_at' => '2020-03-12 20:31:14',
            ),
            8 => 
            array (
                'id' => 9,
                'role_id' => 3,
                'permission_id' => 1,
                'value' => 1,
                'value_name' => 'READ',
                'created_at' => '2020-03-12 20:31:14',
                'updated_at' => '2020-03-12 20:31:14',
            ),
            9 => 
            array (
                'id' => 10,
                'role_id' => 3,
                'permission_id' => 2,
                'value' => 1,
                'value_name' => 'READ',
                'created_at' => '2020-03-12 20:31:14',
                'updated_at' => '2020-03-12 20:31:14',
            ),
            10 => 
            array (
                'id' => 11,
                'role_id' => 3,
                'permission_id' => 3,
                'value' => 1,
                'value_name' => 'READ',
                'created_at' => '2020-03-12 20:31:14',
                'updated_at' => '2020-03-12 20:31:14',
            ),
            11 => 
            array (
                'id' => 12,
                'role_id' => 3,
                'permission_id' => 4,
                'value' => 0,
                'value_name' => 'NONE',
                'created_at' => '2020-03-12 20:31:14',
                'updated_at' => '2020-03-12 20:31:14',
            ),
        ));
        
        
    }
}