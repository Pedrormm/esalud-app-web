<?php

use Illuminate\Database\Seeder;

class PatientsDoctorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('patients_doctors')->delete();
        
        \DB::table('patients_doctors')->insert(array (
            0 => 
            array (
                'id' => 13,
                'user_id_doctor' => 11,
                'user_id_patient' => 5,
                'deleted_at' => null,
                'created_at' => '2020-02-17 20:24:03',
                'updated_at' => '2020-02-17 20:24:03',
            ),
            1 => 
            array (
                'id' => 16,
                'user_id_doctor' => 2,
                'user_id_patient' => 5,
                'deleted_at' => null,
                'created_at' => '2020-02-17 20:24:03',
                'updated_at' => '2020-02-17 20:24:03',
            ),
            2 => 
            array (
                'id' => 19,
                'user_id_doctor' => 2,
                'user_id_patient' => 4,
                'deleted_at' => date("Y-m-d H:i:s"),
                'created_at' => '2020-02-17 20:24:03',
                'updated_at' => '2020-02-17 20:24:03',
            ),
            3 => 
            array (
                'id' => 20,
                'user_id_doctor' => 11,
                'user_id_patient' => 4,
                'deleted_at' => null,
                'created_at' => '2020-02-17 20:24:03',
                'updated_at' => '2020-02-17 20:24:03',
            ),
            4 => 
            array (
                'id' => 21,
                'user_id_doctor' => 11,
                'user_id_patient' => 6,
                'deleted_at' => null,
                'created_at' => '2020-02-17 20:24:03',
                'updated_at' => '2020-02-17 20:24:03',
            ),
            5 => 
            array (
                'id' => 23,
                'user_id_doctor' => 2,
                'user_id_patient' => 10,
                'deleted_at' => date("Y-m-d H:i:s"),
                'created_at' => '2020-02-17 20:24:03',
                'updated_at' => '2020-02-17 20:24:03',
            ),
            6 => 
            array (
                'id' => 25,
                'user_id_doctor' => 11,
                'user_id_patient' => 10,
                'deleted_at' => null,
                'created_at' => '2020-02-17 20:24:03',
                'updated_at' => '2020-02-17 20:24:03',
            ),
            7 => 
            array (
                'id' => 26,
                'user_id_doctor' => 14,
                'user_id_patient' => 6,
                'deleted_at' => null,
                'created_at' => '2020-02-17 20:24:03',
                'updated_at' => '2020-02-17 20:24:03',
            ),
            8 => 
            array (
                'id' => 27,
                'user_id_doctor' => 16,
                'user_id_patient' => 17,
                'deleted_at' => null,
                'created_at' => '2020-02-17 20:24:03',
                'updated_at' => '2020-02-17 20:24:03',
            ),
            9 => 
            array (
                'id' => 28,
                'user_id_doctor' => 11,
                'user_id_patient' => 17,
                'deleted_at' => null,
                'created_at' => '2020-02-17 20:24:03',
                'updated_at' => '2020-02-17 20:24:03',
            ),
            10 => 
            array (
                'id' => 29,
                'user_id_doctor' => 12,
                'user_id_patient' => 17,
                'deleted_at' => null,
                'created_at' => '2020-02-17 20:24:03',
                'updated_at' => '2020-02-17 20:24:03',
            ),
            11 => 
            array (
                'id' => 30,
                'user_id_doctor' => 12,
                'user_id_patient' => 19,
                'deleted_at' => null,
                'created_at' => '2020-02-17 20:24:03',
                'updated_at' => '2020-02-17 20:24:03',
            ),
            12 => 
            array (
                'id' => 31,
                'user_id_doctor' => 2,
                'user_id_patient' => 20,
                'deleted_at' => null,
                'created_at' => '2020-02-17 20:24:03',
                'updated_at' => '2020-02-17 20:24:03',
            ),
            13 => 
            array (
                'id' => 32,
                'user_id_doctor' => 2,
                'user_id_patient' => 10,
                'deleted_at' => date("Y-m-d H:i:s"),
                'created_at' => '2020-02-17 20:24:03',
                'updated_at' => '2020-02-17 20:24:03',
            ),
            14 => 
            array (
                'id' => 33,
                'user_id_doctor' => 2,
                'user_id_patient' => 10,
                'deleted_at' => date("Y-m-d H:i:s"),
                'created_at' => '2020-02-17 20:24:03',
                'updated_at' => '2020-02-17 20:24:03',
            ),
            15 => 
            array (
                'id' => 34,
                'user_id_doctor' => 2,
                'user_id_patient' => 10,
                'deleted_at' => null,
                'created_at' => '2020-02-17 20:24:03',
                'updated_at' => '2020-02-17 20:24:03',
            ),
            16 => 
            array (
                'id' => 36,
                'user_id_doctor' => 25,
                'user_id_patient' => 21,
                'deleted_at' => date("Y-m-d H:i:s"),
                'created_at' => '2020-02-17 20:24:03',
                'updated_at' => '2020-02-17 20:24:03',
            ),
            17 => 
            array (
                'id' => 37,
                'user_id_doctor' => 25,
                'user_id_patient' => 21,
                'deleted_at' => date("Y-m-d H:i:s"),
                'created_at' => '2020-02-17 20:24:03',
                'updated_at' => '2020-02-17 20:24:03',
            ),
            18 => 
            array (
                'id' => 38,
                'user_id_doctor' => 25,
                'user_id_patient' => 21,
                'deleted_at' => null,
                'created_at' => '2020-02-17 20:24:03',
                'updated_at' => '2020-02-17 20:24:03',
            ),
            19 => 
            array (
                'id' => 39,
                'user_id_doctor' => 25,
                'user_id_patient' => 26,
                'deleted_at' => null,
                'created_at' => '2020-02-17 20:24:03',
                'updated_at' => '2020-02-17 20:24:03',
            ),
        ));
    }
}
