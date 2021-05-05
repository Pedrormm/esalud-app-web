<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class StaffScheduleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        
        \DB::table('staff_schedules')->insert(

            [
                [
                    'staff_id' => '1',
                    'starting_workday_time' => "11:00",
                    'ending_workday_time' => "18:00",
                    'weekday' => '1',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")                  
                ],
                [
                    'staff_id' => '1',
                    'starting_workday_time' => "15:00",
                    'ending_workday_time' => "23:00",
                    'weekday' => '2',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s") 
                ],
                [
                    'staff_id' => '1',
                    'starting_workday_time' => "06:00",
                    'ending_workday_time' => "13:00",
                    'weekday' => '3',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")  
                ],
                [
                    'staff_id' => '1',
                    'starting_workday_time' => "15:00",
                    'ending_workday_time' => "18:00",
                    'weekday' => '3',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")  
                ],
                [
                    'staff_id' => '1',
                    'starting_workday_time' => "11:00",
                    'ending_workday_time' => "17:00",
                    'weekday' => '4',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s") 
                ],
                [
                    'staff_id' => '1',
                    'starting_workday_time' => "12:00",
                    'ending_workday_time' => "15:00",
                    'weekday' => '5',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s") 
                ],
                [
                    'staff_id' => '1',
                    'starting_workday_time' => "09:00",
                    'ending_workday_time' => "20:00",
                    'weekday' => '6',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")  
                ],
                [
                    'staff_id' => '1',
                    'starting_workday_time' => "10:00",
                    'ending_workday_time' => "13:00",
                    'weekday' => '7',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s") 
                ],
                [
                    'staff_id' => '1',
                    'starting_workday_time' => "17:00",
                    'ending_workday_time' => "20:00",
                    'weekday' => '7',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s") 
                ],
            ]

        );
        
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
