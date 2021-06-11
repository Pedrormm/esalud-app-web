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
                'historic' => '305049',
                'branch_id' => 13,
                'office' => '41',
                'room' => '666',
                'h_phone' => '112',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ),
            1 => 
            array (
                'user_id' => 15,
                'historic' => '151131',
                'branch_id' => 14,
                'office' => '30',
                'room' => '25',
                'h_phone' => '7777',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ),
            2 => 
            array (
                'user_id' => 18,
                'historic' => '286722',
                'branch_id' => 42,
                'office' => '763',
                'room' => '343G',
                'h_phone' => '3343',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ),
            3 => 
            array (
                'user_id' => 3,
                'historic' => '677372',
                'branch_id' => 42,
                'office' => '125',
                'room' => '112',
                'h_phone' => '9996',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ),
            4 => 
            array (
                'user_id' => 24,
                'historic' => '790333',
                'branch_id' => 46,
                'office' => '34T',
                'room' => 'DKC1',
                'h_phone' => '4443',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ),
            5 => 
            array (
                'user_id' => 11,
                'historic' => '184096',
                'branch_id' => 25,
                'office' => '444',
                'room' => '201',
                'h_phone' => '4591',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ),
            6 => 
            array (
                'user_id' => 14,
                'historic' => '990052',
                'branch_id' => 8,
                'office' => 300,
                'room' => 'S30',
                'h_phone' => '9882',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ),
            7 => 
            array (
                'user_id' => 12,
                'historic' => '555989',
                'branch_id' => 46,
                'office' => '55P',
                'room' => '56D',
                'h_phone' => '9003',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ),
            8 => 
            array (
                'user_id' => 25,
                'historic' => '684126',
                'branch_id' => 20,
                'office' => '20',
                'room' => '0090T',
                'h_phone' => '9001',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ),
            9 => 
            array (
                'user_id' => 16,
                'historic' => '439946',
                'branch_id' => 33,
                'office' => '005',
                'room' => '55L',
                'h_phone' => '2809',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ),

            10 => 
            array (
                'user_id' => 7,
                'historic' => '827936',
                'branch_id' => 12,
                'office' => '41',
                'room' => '666',
                'h_phone' => '112',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ),
            11 => 
            array (
                'user_id' => 23,
                'historic' => '310365',
                'branch_id' => 19,
                'office' => '431',
                'room' => '232',
                'h_phone' => '0999',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ),
            12 => 
            array (
                'user_id' => 29,
                'historic' => '708238',
                'branch_id' => 22,
                'office' => '33',
                'room' => '6661',
                'h_phone' => '4312',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ),
            13 => 
            array (
                'user_id' => 30,
                'historic' => '516641',
                'branch_id' => 6,
                'office' => 'S3',
                'room' => '646',
                'h_phone' => '1112',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ),
            14 => 
            array (
                'user_id' => 22,
                'historic' => '516650',
                'branch_id' => 46,
                'office' => 'EF3',
                'room' => '663',
                'h_phone' => '4142',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ),
         

        ));
        
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        
    }
}