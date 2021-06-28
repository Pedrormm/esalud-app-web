<?php

namespace Database\Seeders;
use DB;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class AppointmentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        \DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        \DB::table('appointments')->insert(
            $valuesInsert = array();
            for($i=0; $i<20; $i++) {

                $valuesInsert[] = 
            }
            return $valuesInsert;
            [
                [
                    'user_id_patient'=>17,
                    'user_id_creator'=>3,
                    'user_id_creator'=>3,
                    'dt_appointment' => "2021-1-2 " + Appointments::where('day_week', Carbon::dayWeek("2021-1-2"))->first()->time_start;
                    'checked'=>rand(0, 2),
                    'accomplished'=>0,
                    'comments'=>"",
                    'user_comment'=>"",
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'user_id_patient'=>17,
                    'user_id_creator'=>3,
                    'user_id_creator'=>3,
                    'dt_appointment' => Carbon::now()->addHours(rand(1, 22))->addDays(rand(2, 30))->addMonths(rand(5, 15)),
                    'checked'=>rand(0, 2),
                    'accomplished'=>0,
                    'comments'=>"",
                    'user_comment'=>"",
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'user_id_patient'=>20,
                    'user_id_creator'=>3,
                    'user_id_creator'=>3,
                    'dt_appointment' => Carbon::now()->addHours(rand(1, 22))->addDays(rand(2, 30))->addMonths(rand(5, 15)),
                    'checked'=>rand(0, 2),
                    'accomplished'=>0,
                    'comments'=>"",
                    'user_comment'=>"",
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'user_id_patient'=>26,
                    'user_id_creator'=>3,
                    'user_id_creator'=>3,
                    'dt_appointment' => Carbon::now()->addHours(rand(1, 22))->addDays(rand(2, 30))->addMonths(rand(5, 15)),
                    'checked'=>rand(0, 2),
                    'accomplished'=>0,
                    'comments'=>"",
                    'user_comment'=>"",
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'user_id_patient'=>20,
                    'user_id_creator'=>3,
                    'user_id_creator'=>3,
                    'dt_appointment' => Carbon::now()->addHours(rand(1, 22))->addDays(rand(2, 30))->addMonths(rand(5, 15)),
                    'checked'=>rand(0, 2),
                    'accomplished'=>0,
                    'comments'=>"",
                    'user_comment'=>"",
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],                
                [
                    'user_id_patient'=>19,
                    'user_id_creator'=>3,
                    'user_id_creator'=>3,
                    'dt_appointment' => Carbon::now()->addHours(rand(1, 22))->addDays(rand(2, 30))->addMonths(rand(5, 15)),
                    'checked'=>rand(0, 2),
                    'accomplished'=>0,
                    'comments'=>"",
                    'user_comment'=>"",
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],                
                [
                    'user_id_patient'=>21,
                    'user_id_creator'=>3,
                    'user_id_creator'=>3,
                    'dt_appointment' => Carbon::now()->addHours(rand(1, 22))->addDays(rand(2, 30))->addMonths(rand(5, 15)),
                    'checked'=>rand(0, 2),
                    'accomplished'=>0,
                    'comments'=>"",
                    'user_comment'=>"",
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],                
                [
                    'user_id_patient'=>10,
                    'user_id_creator'=>3,
                    'user_id_creator'=>3,
                    'dt_appointment' => Carbon::now()->addHours(rand(1, 22))->addDays(rand(2, 30))->addMonths(rand(5, 15)),
                    'checked'=>rand(0, 2),
                    'accomplished'=>0,
                    'comments'=>"",
                    'user_comment'=>"",
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],                
                [
                    'user_id_patient'=>6,
                    'user_id_creator'=>3,
                    'user_id_creator'=>3,
                    'dt_appointment' => Carbon::now()->addHours(rand(1, 22))->addDays(rand(2, 30))->addMonths(rand(5, 15)),
                    'checked'=>rand(0, 2),
                    'accomplished'=>0,
                    'comments'=>"",
                    'user_comment'=>"",
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'user_id_patient'=>4,
                    'user_id_creator'=>3,
                    'user_id_creator'=>3,
                    'dt_appointment' => Carbon::now()->addHours(rand(1, 22))->addDays(rand(2, 30))->addMonths(rand(5, 15)),
                    'checked'=>rand(0, 2),
                    'accomplished'=>0,
                    'comments'=>"",
                    'user_comment'=>"",
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'user_id_patient'=>27,
                    'user_id_creator'=>3,
                    'user_id_creator'=>3,
                    'dt_appointment' => Carbon::now()->addHours(rand(1, 22))->addDays(rand(2, 30))->addMonths(rand(5, 15)),
                    'checked'=>rand(0, 2),
                    'accomplished'=>0,
                    'comments'=>"",
                    'user_comment'=>"",
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'user_id_patient'=>31,
                    'user_id_creator'=>3,
                    'user_id_creator'=>3,
                    'dt_appointment' => Carbon::now()->addHours(rand(1, 22))->addDays(rand(2, 30))->addMonths(rand(5, 15)),
                    'checked'=>rand(0, 2),
                    'accomplished'=>0,
                    'comments'=>"",
                    'user_comment'=>"",
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],

                [
                    'user_id_patient'=>17,
                    'user_id_creator'=>15,
                    'user_id_creator'=>15,
                    'dt_appointment' => Carbon::now()->addHours(rand(1, 22))->addDays(rand(2, 30))->addMonths(rand(5, 15)),
                    'checked'=>rand(0, 2),
                    'accomplished'=>0,
                    'comments'=>"",
                    'user_comment'=>"",
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'user_id_patient'=>20,
                    'user_id_creator'=>15,
                    'user_id_creator'=>15,
                    'dt_appointment' => Carbon::now()->addHours(rand(1, 22))->addDays(rand(2, 30))->addMonths(rand(5, 15)),
                    'checked'=>rand(0, 2),
                    'accomplished'=>0,
                    'comments'=>"",
                    'user_comment'=>"",
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'user_id_patient'=>26,
                    'user_id_creator'=>15,
                    'user_id_creator'=>15,
                    'dt_appointment' => Carbon::now()->addHours(rand(1, 22))->addDays(rand(2, 30))->addMonths(rand(5, 15)),
                    'checked'=>rand(0, 2),
                    'accomplished'=>0,
                    'comments'=>"",
                    'user_comment'=>"",
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'user_id_patient'=>20,
                    'user_id_creator'=>15,
                    'user_id_creator'=>15,
                    'dt_appointment' => Carbon::now()->addHours(rand(1, 22))->addDays(rand(2, 30))->addMonths(rand(5, 15)),
                    'checked'=>rand(0, 2),
                    'accomplished'=>0,
                    'comments'=>"",
                    'user_comment'=>"",
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],                
                [
                    'user_id_patient'=>19,
                    'user_id_creator'=>15,
                    'user_id_creator'=>15,
                    'dt_appointment' => Carbon::now()->addHours(rand(1, 22))->addDays(rand(2, 30))->addMonths(rand(5, 15)),
                    'checked'=>rand(0, 2),
                    'accomplished'=>0,
                    'comments'=>"",
                    'user_comment'=>"",
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],                
                [
                    'user_id_patient'=>21,
                    'user_id_creator'=>15,
                    'user_id_creator'=>15,
                    'dt_appointment' => Carbon::now()->addHours(rand(1, 22))->addDays(rand(2, 30))->addMonths(rand(5, 15)),
                    'checked'=>rand(0, 2),
                    'accomplished'=>0,
                    'comments'=>"",
                    'user_comment'=>"",
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],                
                [
                    'user_id_patient'=>10,
                    'user_id_creator'=>15,
                    'user_id_creator'=>15,
                    'dt_appointment' => Carbon::now()->addHours(rand(1, 22))->addDays(rand(2, 30))->addMonths(rand(5, 15)),
                    'checked'=>rand(0, 2),
                    'accomplished'=>0,
                    'comments'=>"",
                    'user_comment'=>"",
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],                
                [
                    'user_id_patient'=>6,
                    'user_id_creator'=>15,
                    'user_id_creator'=>15,
                    'dt_appointment' => Carbon::now()->addHours(rand(1, 22))->addDays(rand(2, 30))->addMonths(rand(5, 15)),
                    'checked'=>rand(0, 2),
                    'accomplished'=>0,
                    'comments'=>"",
                    'user_comment'=>"",
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'user_id_patient'=>4,
                    'user_id_creator'=>15,
                    'user_id_creator'=>15,
                    'dt_appointment' => Carbon::now()->addHours(rand(1, 22))->addDays(rand(2, 30))->addMonths(rand(5, 15)),
                    'checked'=>rand(0, 2),
                    'accomplished'=>0,
                    'comments'=>"",
                    'user_comment'=>"",
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'user_id_patient'=>27,
                    'user_id_creator'=>15,
                    'user_id_creator'=>15,
                    'dt_appointment' => Carbon::now()->addHours(rand(1, 22))->addDays(rand(2, 30))->addMonths(rand(5, 15)),
                    'checked'=>rand(0, 2),
                    'accomplished'=>0,
                    'comments'=>"",
                    'user_comment'=>"",
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'user_id_patient'=>31,
                    'user_id_creator'=>15,
                    'user_id_creator'=>15,
                    'dt_appointment' => Carbon::now()->addHours(rand(1, 22))->addDays(rand(2, 30))->addMonths(rand(5, 15)),
                    'checked'=>rand(0, 2),
                    'accomplished'=>0,
                    'comments'=>"",
                    'user_comment'=>"",
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],

                [
                    'user_id_patient'=>4,
                    'user_id_creator'=>1,
                    'user_id_creator'=>22,
                    'dt_appointment' => Carbon::now()->addHours(rand(1, 22))->addDays(rand(2, 30))->addMonths(rand(5, 15)),
                    'checked'=>rand(0, 2),
                    'accomplished'=>0,
                    'comments'=>"",
                    'user_comment'=>"",
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'user_id_patient'=>27,
                    'user_id_creator'=>1,
                    'user_id_creator'=>30,
                    'dt_appointment' => Carbon::now()->addHours(rand(1, 22))->addDays(rand(2, 30))->addMonths(rand(5, 15)),
                    'checked'=>rand(0, 2),
                    'accomplished'=>0,
                    'comments'=>"",
                    'user_comment'=>"",
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'user_id_patient'=>31,
                    'user_id_creator'=>1,
                    'user_id_creator'=>29,
                    'dt_appointment' => Carbon::now()->addHours(rand(1, 22))->addDays(rand(2, 30))->addMonths(rand(5, 15)),
                    'checked'=>rand(0, 2),
                    'accomplished'=>0,
                    'comments'=>"",
                    'user_comment'=>"",
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'user_id_patient'=>10,
                    'user_id_creator'=>1,
                    'user_id_creator'=>29,
                    'dt_appointment' => Carbon::now()->addHours(rand(1, 22))->addDays(rand(2, 30))->addMonths(rand(5, 15)),
                    'checked'=>rand(0, 2),
                    'accomplished'=>0,
                    'comments'=>"",
                    'user_comment'=>"",
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],                
                [
                    'user_id_patient'=>6,
                    'user_id_creator'=>1,
                    'user_id_creator'=>29,
                    'dt_appointment' => Carbon::now()->addHours(rand(1, 22))->addDays(rand(2, 30))->addMonths(rand(5, 15)),
                    'checked'=>rand(0, 2),
                    'accomplished'=>0,
                    'comments'=>"",
                    'user_comment'=>"",
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
            ]
        );

        \DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        
    }
}
