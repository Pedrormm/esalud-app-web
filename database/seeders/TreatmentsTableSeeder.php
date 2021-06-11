<?php

namespace Database\Seeders;
use DB;
use Illuminate\Database\Seeder;
class TreatmentsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
         DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        
        \DB::table('treatments')->insert(

            [
                [
                    'user_id_patient' => 10,
                    'user_id_doctor' => 2,
                    'type_medicine_id' => 12,
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")                  
                ],
                [
                    'user_id_patient' => 17,
                    'user_id_doctor' => 2,
                    'type_medicine_id' => 30,
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")  
                ],
                [
                    'user_id_patient' => 17,
                    'user_id_doctor' => 2,
                    'type_medicine_id' => 10,
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")  
                ],
                [
                    'user_id_patient' => 4,
                    'user_id_doctor' => 2,
                    'type_medicine_id' => 12,
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")  
                ],
                [
                    'user_id_patient' => 17,
                    'user_id_doctor' => 2,
                    'type_medicine_id' => 25,
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")  
                ],
                [
                    'user_id_patient' => 17,
                    'user_id_doctor' => 2,
                    'type_medicine_id' => 17,
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")  
                ],
                [
                    'user_id_patient' => 17,
                    'user_id_doctor' => 2,
                    'type_medicine_id' => 11,
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")  
                ],
                [
                    'user_id_patient' => 17,
                    'user_id_doctor' => 3,
                    'type_medicine_id' =>9,
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")  
                ],
                [
                    'user_id_patient' => 17,
                    'user_id_doctor' => 2,
                    'type_medicine_id' => 44,
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")  
                ],
                [
                    'user_id_patient' => 10,
                    'user_id_doctor' => 2,
                    'type_medicine_id' => 22,
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")  
                ],
                [
                    'user_id_patient' => 10,
                    'user_id_doctor' => 2,
                    'type_medicine_id' => 115,
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")  
                ],
                [
                    'user_id_patient' => 10,
                    'user_id_doctor' => 2,
                    'type_medicine_id' => 35,
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")  
                ],
                [
                    'user_id_patient' => 19,
                    'user_id_doctor' => 12,
                    'type_medicine_id' => 1,
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")  
                ],
                [
                    'user_id_patient' => 10,
                    'user_id_doctor' => 2,
                    'type_medicine_id' => 18,
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")  
                ],
                [
                    'user_id_patient' => 10,
                    'user_id_doctor' => 2,
                    'type_medicine_id' => 92,
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")  
                ],
                [
                    'user_id_patient' => 26,
                    'user_id_doctor' => 25,
                    'type_medicine_id' => 2,
                    // 'medicine_administration_id' => 3,
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")  
                ],
                [
                    'user_id_patient' => 26,
                    'user_id_doctor' => 14,
                    'type_medicine_id' => 3,
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")  
                ],
            ]

        );
        
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        
    }
}