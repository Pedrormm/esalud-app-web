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
                'id' => 21,
                'user_id' => 17,
                'historic' => '111444555',
                'height' => 0,
                'weight' => 0,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ),
            1 => 
            array (
                'id' => 22,
                'user_id' => 20,
                'historic' => '123456789',
                'height' => 172,
                'weight' => 76,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ),
            2 => 
            array (
                'id' => 23,
                'user_id' => 26,
                'historic' => '1318020427',
                'height' => 180,
                'weight' => 80,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ),
            3 => 
            array (
                'id' => 24,
                'user_id' => 19,
                'historic' => '22215128345100',
                'height' => 0,
                'weight' => 0,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ),
            4 => 
            array (
                'id' => 25,
                'user_id' => 5,
                'historic' => '36843287',
                'height' => 159,
                'weight' => 58,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ),
            5 => 
            array (
                'id' => 26,
                'user_id' => 21,
                'historic' => '425412189',
                'height' => 180,
                'weight' => 76,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ),
            6 => 
            array (
                'id' => 27,
                'user_id' => 10,
                'historic' => '4565454',
                'height' => 178,
                'weight' => 86,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ),
            7 => 
            array (
                'id' => 28,
                'user_id' => 6,
                'historic' => '5users445300',
                'height' => 198,
                'weight' => 110,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ),
            8 => 
            array (
                'id' => 29,
                'user_id' => 4,
                'historic' => '987654321',
                'height' => 180,
                'weight' => 96,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ),
        ));
        
        
    }
}