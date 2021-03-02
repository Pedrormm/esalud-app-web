<?php

namespace Database\Seeders;
use DB;
use Illuminate\Database\Seeder;
class MedicinesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
         DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        
        \DB::table('medicines')->insert(array (
            0 => 
            array (
                'id' => 1,
                'user_id_patient' => 10,
                'user_id_doctor' => 2,
                'type_medicine_id' => 12,
                'interval' => '1#24#h',
                'stop' => 'El paciente sufre una intolerancia a la medicación, mejor evitarlo',
                'stop_user' => 2,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ),
            1 => 
            array (
                'id' => 2,
                'user_id_patient' => 17,
                'user_id_doctor' => 2,
                'type_medicine_id' => 30,
                'interval' => '4#1#d',
                'stop' => 'No tolera el tratamiento',
                'stop_user' => 2,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ),
            2 => 
            array (
                'id' => 3,
                'user_id_patient' => 17,
                'user_id_doctor' => 2,
                'type_medicine_id' => 10,
                'interval' => '3#1#d',
                'stop' => '0',
                'stop_user' => 0,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ),
            3 => 
            array (
                'id' => 4,
                'user_id_patient' => 4,
                'user_id_doctor' => 2,
                'type_medicine_id' => 12,
                'interval' => '1#1#d',
                'stop' => '0',
                'stop_user' => 0,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ),
            4 => 
            array (
                'id' => 5,
                'user_id_patient' => 4,
                'user_id_doctor' => 2,
                'type_medicine_id' => 25,
                'interval' => '1#15#d',
                'stop' => '0',
                'stop_user' => 0,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ),
            5 => 
            array (
                'id' => 6,
                'user_id_patient' => 17,
                'user_id_doctor' => 2,
                'type_medicine_id' => 25,
                'interval' => '4#1#d',
                'stop' => '',
                'stop_user' => 0,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ),
            6 => 
            array (
                'id' => 7,
                'user_id_patient' => 17,
                'user_id_doctor' => 2,
                'type_medicine_id' => 17,
                'interval' => '5#2#m',
                'stop' => 'Mejor no empezarlo',
                'stop_user' => 2,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ),
            7 => 
            array (
                'id' => 8,
                'user_id_patient' => 17,
                'user_id_doctor' => 2,
                'type_medicine_id' => 11,
                'interval' => '1#8#h',
                'stop' => '',
                'stop_user' => 0,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ),
            8 => 
            array (
                'id' => 9,
                'user_id_patient' => 17,
                'user_id_doctor' => 3,
                'type_medicine_id' =>9,
                'interval' => '2#6#h',
                'stop' => '',
                'stop_user' => 0,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ),
            9 => 
            array (
                'id' => 10,
                'user_id_patient' => 17,
                'user_id_doctor' => 2,
                'type_medicine_id' => 44,
                'interval' => '1#12#h',
                'stop' => '',
                'stop_user' => 0,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ),
            10 => 
            array (
                'id' => 11,
                'user_id_patient' => 10,
                'user_id_doctor' => 2,
                'type_medicine_id' => 22,
                'interval' => '1#8#h',
                'stop' => 'Erronea',
                'stop_user' => 2,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ),
            11 => 
            array (
                'id' => 12,
                'user_id_patient' => 10,
                'user_id_doctor' => 2,
                'type_medicine_id' => 115,
                'interval' => '2#1#w',
                'stop' => '',
                'stop_user' => 0,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ),
            12 => 
            array (
                'id' => 13,
                'user_id_patient' => 10,
                'user_id_doctor' => 2,
                'type_medicine_id' => 35,
                'interval' => '4#1#d',
                'stop' => '',
                'stop_user' => 0,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ),
            13 => 
            array (
                'id' => 14,
                'user_id_patient' => 19,
                'user_id_doctor' => 12,
                'type_medicine_id' => 1,
                'interval' => '1#1#d',
                'stop' => '',
                'stop_user' => 0,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ),
            14 => 
            array (
                'id' => 15,
                'user_id_patient' => 10,
                'user_id_doctor' => 2,
                'type_medicine_id' => 18,
                'interval' => '5#2#w',
                'stop' => '',
                'stop_user' => 0,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ),
            15 => 
            array (
                'id' => 16,
                'user_id_patient' => 10,
                'user_id_doctor' => 2,
                'type_medicine_id' => 92,
                'interval' => '1#1#m',
                'stop' => '',
                'stop_user' => 0,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ),
            16 => 
            array (
                'id' => 18,
                'user_id_patient' => 26,
                'user_id_doctor' => 25,
                'type_medicine_id' => 1,
                'interval' => '1#8#h',
                'stop' => '',
                'stop_user' => 0,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ),
        ));
        
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        
    }
}