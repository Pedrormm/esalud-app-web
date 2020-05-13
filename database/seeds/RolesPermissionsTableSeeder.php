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
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ),
            1 => 
            array (
                'id' => 2,
                'role_id' => 1,
                'permission_id' => 2,
                'value' => 2,
                'value_name' => 'READ_AND_WRITE',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ),
            2 => 
            array (
                'id' => 3,
                'role_id' => 1,
                'permission_id' => 3,
                'value' => 2,
                'value_name' => 'READ_AND_WRITE',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ),
            3 => 
            array (
                'id' => 4,
                'role_id' => 1,
                'permission_id' => 4,
                'value' => 2,
                'value_name' => 'READ_AND_WRITE',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ),
            4 => 
            array (
                'id' => 5,
                'role_id' => 2,
                'permission_id' => 1,
                'value' => 1,
                'value_name' => 'READ',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ),
            5 => 
            array (
                'id' => 6,
                'role_id' => 2,
                'permission_id' => 2,
                'value' => 2,
                'value_name' => 'READ_AND_WRITE',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ),
            6 => 
            array (
                'id' => 7,
                'role_id' => 2,
                'permission_id' => 3,
                'value' => 0,
                'value_name' => 'NONE',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ),
            7 => 
            array (
                'id' => 8,
                'role_id' => 2,
                'permission_id' => 4,
                'value' => 1,
                'value_name' => 'READ',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ),
            8 => 
            array (
                'id' => 9,
                'role_id' => 3,
                'permission_id' => 1,
                'value' => 1,
                'value_name' => 'READ',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ),
            9 => 
            array (
                'id' => 10,
                'role_id' => 3,
                'permission_id' => 2,
                'value' => 1,
                'value_name' => 'READ',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ),
            10 => 
            array (
                'id' => 11,
                'role_id' => 3,
                'permission_id' => 3,
                'value' => 1,
                'value_name' => 'READ',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ),
            11 => 
            array (
                'id' => 12,
                'role_id' => 3,
                'permission_id' => 4,
                'value' => 0,
                'value_name' => 'NONE',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ),
            12 => 
            array (
                'id' => 13,
                'role_id' => 4,
                'permission_id' => 1,
                'value' => 2,
                'value_name' => 'READ_AND_WRITE',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ),
            13 => 
            array (
                'id' => 14,
                'role_id' => 4,
                'permission_id' => 2,
                'value' => 2,
                'value_name' => 'READ_AND_WRITE',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ),
            14 => 
            array (
                'id' => 15,
                'role_id' => 4,
                'permission_id' => 3,
                'value' => 2,
                'value_name' => 'READ_AND_WRITE',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ),
            15 => 
            array (
                'id' => 16,
                'role_id' => 4,
                'permission_id' => 4,
                'value' => 2,
                'value_name' => 'READ_AND_WRITE',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ),
            16 => 
            array (
                'id' => 17,
                'role_id' => 5,
                'permission_id' => 1,
                'value' => 0,
                'value_name' => 'NONE',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ),
            17 => 
            array (
                'id' => 18,
                'role_id' => 5,
                'permission_id' => 2,
                'value' => 0,
                'value_name' => 'NONE',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ),
            18 => 
            array (
                'id' => 19,
                'role_id' => 5,
                'permission_id' => 3,
                'value' => 0,
                'value_name' => 'NONE',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ),
            19 => 
            array (
                'id' => 20,
                'role_id' => 5,
                'permission_id' => 4,
                'value' => 0,
                'value_name' => 'NONE',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ),
        ));
        
        
    }
}