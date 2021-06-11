<?php

namespace Database\Seeders;
use DB;
use Illuminate\Database\Seeder;
class PatientsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('patients')->delete();
        
        \DB::table('patients')->insert(array (
            0 => 
            array (
                'id' => 1,
                'user_id' => 17,
                'historic' => '442795863',
                'height' => 161,
                'weight' => 61,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ),
            1 => 
            array (
                'id' => 2,
                'user_id' => 20,
                'historic' => '384325109',
                'height' => 172,
                'weight' => 76,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ),
            2 => 
            array (
                'id' => 3,
                'user_id' => 26,
                'historic' => '935647675',
                'height' => 180,
                'weight' => 81,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ),
            3 => 
            array (
                'id' => 4,
                'user_id' => 19,
                'historic' => '762877810',
                'height' => 171,
                'weight' => 63,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ),
            4 => 
            array (
                'id' => 5,
                'user_id' => 5,
                'historic' => '305233559',
                'height' => 159,
                'weight' => 58,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ),
            5 => 
            array (
                'id' => 6,
                'user_id' => 21,
                'historic' => '425412189',
                'height' => 180,
                'weight' => 76,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ),
            6 => 
            array (
                'id' => 7,
                'user_id' => 10,
                'historic' => '969319652',
                'height' => 178,
                'weight' => 86,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ),
            7 => 
            array (
                'id' => 8,
                'user_id' => 6,
                'historic' => '389736147',
                'height' => 198,
                'weight' => 110,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ),
            8 => 
            array (
                'id' => 9,
                'user_id' => 4,
                'historic' => '559808318',
                'height' => 180,
                'weight' => 96,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ),

            9 => 
            array (
                'id' => 10,
                'user_id' => 27,
                'historic' => '581356347',
                'height' => 170,
                'weight' => 100,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ),
            10 => 
            array (
                'id' => 11,
                'user_id' => 31,
                'historic' => '817746340',
                'height' => 175,
                'weight' => 80,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ),

        ));
        
        
    }
}