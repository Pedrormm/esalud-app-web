<?php

namespace Database\Seeders;
use DB;
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
                'id' => 1,
                'flag_meaning' => 'DASHBOARD',
                'default_permission' => 1,               
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ],
            [
                'id' => 2,
                'flag_meaning' => 'SETTINGS',
                'default_permission' => 1,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ],
            [
                'id' => 3,
                'flag_meaning' => 'USER_MANAGEMENT_CREATE',
                'default_permission' => 0,               
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ],
            [
                'id' => 4,
                'flag_meaning' => 'ALL_USERS_SHOW',
                'default_permission' => 0,               
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ],
            [
                'id' => 5,
                'flag_meaning' => 'ALL_USERS_EDIT',
                'default_permission' => 0,               
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ],
            [
                'id' => 6,
                'flag_meaning' => 'ALL_USERS_DELETE',
                'default_permission' => 0,               
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ],
            [
                'id' => 7,
                'flag_meaning' => 'PATIENT_USER_SHOW',
                'default_permission' => 0,               
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ],
            [
                'id' => 8,
                'flag_meaning' => 'PATIENT_USER_EDIT',
                'default_permission' => 0,               
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ],
            [
                'id' => 9,
                'flag_meaning' => 'PATIENT_USER_DELETE',
                'default_permission' => 0,               
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ],
            [
                'id' => 10,
                'flag_meaning' => 'STAFF_USER_SHOW',
                'default_permission' => 0,               
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ],
            [
                'id' => 11,
                'flag_meaning' => 'STAFF_USER_EDIT',
                'default_permission' => 0,               
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ],
            [
                'id' => 12,
                'flag_meaning' => 'STAFF_USER_DELETE',
                'default_permission' => 0,               
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ],
            [
                'id' => 13,
                'flag_meaning' => 'MEDICAL_RECORD_SHOW_ALL_PATIENTS',
                'default_permission' => 0,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ],
            [
                'id' => 14,
                'flag_meaning' => 'MEDICAL_RECORD_SHOW_OWN',
                'default_permission' => 0,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ],
            [
                'id' => 15,
                'flag_meaning' => 'MEDICAL_TREATMENT_SHOW_ALL',
                'default_permission' => 0,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ],
            [
                'id' => 16,
                'flag_meaning' => 'MEDICAL_TREATMENT_CREATE',
                'default_permission' => 0,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ],
            [
                'id' => 17,
                'flag_meaning' => 'MEDICAL_TREATMENT_SHOW_FROM_SINGLE_PATIENT',
                'default_permission' => 0,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ],
            [
                'id' => 18,
                'flag_meaning' => 'MEDICAL_TREATMENT_DELETE_ALL_FROM_SINGLE_PATIENT',
                'default_permission' => 0,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ],
            [
                'id' => 19,
                'flag_meaning' => 'MEDICAL_TREATMENT_EDIT',
                'default_permission' => 0,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ],
            [
                'id' => 20,
                'flag_meaning' => 'MEDICAL_TREATMENT_SHOW_DESCRIPTION',
                'default_permission' => 0,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ],
            [
                'id' => 21,
                'flag_meaning' => 'MEDICAL_TREATMENT_DELETE_ONE',
                'default_permission' => 0,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ],
            [
                'id' => 22,
                'flag_meaning' => 'MEDICAL_TREATMENT_SHOW_OWN',
                'default_permission' => 0,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ],
            [
                'id' => 23,
                'flag_meaning' => 'SCHEDULE_SHOW_AND_EDIT_ALL',
                'default_permission' => 0,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ],
            [
                'id' => 24,
                'flag_meaning' => 'SCHEDULE_SHOW_AND_EDIT_OWN',
                'default_permission' => 0,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ],
            [
                'id' => 25,
                'flag_meaning' => 'APPOINTMENT_CREATE_ANY_KIND',
                'default_permission' => 0,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ],
            [
                'id' => 26,
                'flag_meaning' => 'APPOINTMENT_WITH_MEDIC_CREATE',
                'default_permission' => 0,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ],
            [
                'id' => 27,
                'flag_meaning' => 'APPOINTMENT_WITH_PATIENT_CREATE',
                'default_permission' => 0,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ],
            [
                'id' => 28,
                'flag_meaning' => 'APPOINTMENT_SHOW_ACCEPTED',
                'default_permission' => 0,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ],
            [
                'id' => 29,
                'flag_meaning' => 'APPOINTMENT_SHOW_REJECTED',
                'default_permission' => 0,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ],
            [
                'id' => 30,
                'flag_meaning' => 'APPOINTMENT_SHOW_PENDING',
                'default_permission' => 0,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ],
            [
                'id' => 31,
                'flag_meaning' => 'APPOINTMENT_SHOW_ALL',
                'default_permission' => 0,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ],
            [
                'id' => 32,
                'flag_meaning' => 'APPOINTMENT_SHOW_OLD_ONES',
                'default_permission' => 0,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ],
            [
                'id' => 33,
                'flag_meaning' => 'APPOINTMENT_CALENDAR_SHOW',
                'default_permission' => 0,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ],
            [
                'id' => 34,
                'flag_meaning' => 'MESSAGING_CHAT_SHOW',
                'default_permission' => 1,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ],
            [
                'id' => 35,
                'flag_meaning' => 'VIDEO_CALL_SHOW',
                'default_permission' => 1,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ],
            [
                'id' => 36,
                'flag_meaning' => 'ROLE_MANAGEMENT',
                'default_permission' => 0,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ],
            [
                'id' => 37,
                'flag_meaning' => 'NEWS',
                'default_permission' => 1,               
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ],
            
        ));
        
        
    }
}