<?php

namespace Database\Seeders;
use DB;
use Illuminate\Database\Seeder;
class StaffTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        
        \DB::table('staff')->insert(array (
            0 => 
            array (
                'user_id' => 2,
                'historic' => '1000000002',
                'branch_id' => 13,
                'shift' => 'EN',
                'office' => '41',
                'room' => '666',
                'h_phone' => '112',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ),
            1 => 
            array (
                'user_id' => 15,
                'historic' => '100000005645I',
                'branch_id' => 14,
                'shift' => 'E',
                'office' => '',
                'room' => '25',
                'h_phone' => '',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ),
            2 => 
            array (
                'user_id' => 18,
                'historic' => '11111111555555',
                'branch_id' => 42,
                'shift' => 'ME',
                'office' => NULL,
                'room' => NULL,
                'h_phone' => NULL,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ),
            3 => 
            array (
                'user_id' => 3,
                'historic' => '153200087',
                'branch_id' => 42,
                'shift' => 'ME',
                'office' => '125',
                'room' => '112',
                'h_phone' => '999662',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ),
            4 => 
            array (
                'user_id' => 24,
                'historic' => '153451331',
                'branch_id' => 46,
                'shift' => 'ME',
                'office' => '',
                'room' => '',
                'h_phone' => '',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ),
            5 => 
            array (
                'user_id' => 11,
                'historic' => '2147483647',
                'branch_id' => 25,
                'shift' => 'MN',
                'office' => '444',
                'room' => '201',
                'h_phone' => NULL,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ),
            6 => 
            array (
                'user_id' => 14,
                'historic' => '4488845454',
                'branch_id' => 13,
                'shift' => 'ME',
                'office' => NULL,
                'room' => NULL,
                'h_phone' => NULL,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ),
            7 => 
            array (
                'user_id' => 12,
                'historic' => '5224751210',
                'branch_id' => 30,
                'shift' => 'M',
                'office' => '55P',
                'room' => '',
                'h_phone' => '',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ),
            8 => 
            array (
                'user_id' => 25,
                'historic' => '597453250',
                'branch_id' => 20,
                'shift' => 'ME',
                'office' => '',
                'room' => 'Urgencias',
                'h_phone' => '',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ),
            9 => 
            array (
                'user_id' => 16,
                'historic' => '8888852O',
                'branch_id' => 33,
                'shift' => 'ME',
                'office' => '005',
                'room' => '55L',
                'h_phone' => NULL,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ),
        ));
        
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        
    }
}