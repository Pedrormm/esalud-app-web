<?php

namespace Database\Seeders;
use DB;
use Illuminate\Database\Seeder;
class RelationsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('relations')->delete();
        
        \DB::table('relations')->insert(array (
            0 => 
            array (
                'id' => 13,
                'user_id_doctor' => 11,
                'user_id_patient' => 5,
                'deleted' => 0,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ),
            1 => 
            array (
                'id' => 16,
                'user_id_doctor' => 2,
                'user_id_patient' => 5,
                'deleted' => 0,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ),
            2 => 
            array (
                'id' => 19,
                'user_id_doctor' => 2,
                'user_id_patient' => 4,
                'deleted' => 1,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ),
            3 => 
            array (
                'id' => 20,
                'user_id_doctor' => 11,
                'user_id_patient' => 4,
                'deleted' => 0,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ),
            4 => 
            array (
                'id' => 21,
                'user_id_doctor' => 11,
                'user_id_patient' => 6,
                'deleted' => 0,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ),
            5 => 
            array (
                'id' => 23,
                'user_id_doctor' => 2,
                'user_id_patient' => 10,
                'deleted' => 1,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ),
            6 => 
            array (
                'id' => 25,
                'user_id_doctor' => 11,
                'user_id_patient' => 10,
                'deleted' => 0,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ),
            7 => 
            array (
                'id' => 26,
                'user_id_doctor' => 14,
                'user_id_patient' => 6,
                'deleted' => 0,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ),
            8 => 
            array (
                'id' => 27,
                'user_id_doctor' => 16,
                'user_id_patient' => 17,
                'deleted' => 0,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ),
            9 => 
            array (
                'id' => 28,
                'user_id_doctor' => 11,
                'user_id_patient' => 17,
                'deleted' => 0,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ),
            10 => 
            array (
                'id' => 29,
                'user_id_doctor' => 12,
                'user_id_patient' => 17,
                'deleted' => 0,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ),
            11 => 
            array (
                'id' => 30,
                'user_id_doctor' => 12,
                'user_id_patient' => 19,
                'deleted' => 0,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ),
            12 => 
            array (
                'id' => 31,
                'user_id_doctor' => 2,
                'user_id_patient' => 20,
                'deleted' => 0,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ),
            13 => 
            array (
                'id' => 32,
                'user_id_doctor' => 2,
                'user_id_patient' => 10,
                'deleted' => 1,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ),
            14 => 
            array (
                'id' => 33,
                'user_id_doctor' => 2,
                'user_id_patient' => 10,
                'deleted' => 1,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ),
            15 => 
            array (
                'id' => 34,
                'user_id_doctor' => 2,
                'user_id_patient' => 10,
                'deleted' => 0,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ),
            16 => 
            array (
                'id' => 36,
                'user_id_doctor' => 25,
                'user_id_patient' => 21,
                'deleted' => 1,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ),
            17 => 
            array (
                'id' => 37,
                'user_id_doctor' => 25,
                'user_id_patient' => 21,
                'deleted' => 1,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ),
            18 => 
            array (
                'id' => 38,
                'user_id_doctor' => 25,
                'user_id_patient' => 21,
                'deleted' => 0,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ),
            19 => 
            array (
                'id' => 39,
                'user_id_doctor' => 25,
                'user_id_patient' => 26,
                'deleted' => 0,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ),
        ));
        
        
    }
}