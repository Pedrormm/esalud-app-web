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
            [
                'flag_meaning' => 'CREATE_USER',
                'default_permission' => 0,               
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ],
            [
                'flag_meaning' => 'SHOW_ALL_USERS',
                'default_permission' => 0,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ],
            [
                'flag_meaning' => 'SHOW_PATIENTS',
                'default_permission' => 0,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ],
            [
                'flag_meaning' => 'SHOW_STAFF',
                'default_permission' => 0,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ],
            [
                'flag_meaning' => 'SHOW_MEDICAL_RECORD',
                'default_permission' => 0,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ],
            [
                'flag_meaning' => 'CREATE_APPOINTMENT',
                'default_permission' => 0,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ],
            [
                'flag_meaning' => 'SHOW_ALL_APPOINTMENTS',
                'default_permission' => 0,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ],
            [
                'flag_meaning' => 'SHOW_ACCEPTED_APPOINTMENTS',
                'default_permission' => 0,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ],
            [
                'flag_meaning' => 'SHOW_PENDING_APPOINTMENTS',
                'default_permission' => 0,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ],
            [
                'flag_meaning' => 'SHOW_CALENDAR',
                'default_permission' => 0,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ],
            [
                'flag_meaning' => 'SHOW_MESSAGING_CHAT',
                'default_permission' => 0,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ],
            [
                'flag_meaning' => 'SHOW_VIDEO_CALL',
                'default_permission' => 0,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ],
            [
                'flag_meaning' => 'ROLE_MANAGEMENT',
                'default_permission' => 0,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ],
            [
                'flag_meaning' => 'MY_PROFILE',
                'default_permission' => 0,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ],
            [
                'flag_meaning' => 'CREATE_NOTES',
                'default_permission' => 0,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ],
            [
                'flag_meaning' => 'SHOW_NOTES',
                'default_permission' => 0,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ],
            [
                'flag_meaning' => 'EDIT_NOTES',
                'default_permission' => 0,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ],
            
        ));
        
        
    }
}