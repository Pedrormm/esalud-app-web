<?php

use Illuminate\Database\Seeder;

class WarningsReadsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('warnings_reads')->delete();
        
        \DB::table('warnings_reads')->insert(array (
            0 => 
            array (
                'id' => 8,
                'user_id' => 2,
                'warning_id' => 4,
                'created_at' => '2020-02-17 20:20:36',
                'updated_at' => '2020-02-17 20:20:36',
            ),
            1 => 
            array (
                'id' => 9,
                'user_id' => 2,
                'warning_id' => 5,
                'created_at' => '2020-02-17 20:20:36',
                'updated_at' => '2020-02-17 20:20:36',
            ),
            2 => 
            array (
                'id' => 10,
                'user_id' => 2,
                'warning_id' => 6,
                'created_at' => '2020-02-17 20:20:36',
                'updated_at' => '2020-02-17 20:20:36',
            ),
            3 => 
            array (
                'id' => 11,
                'user_id' => 2,
                'warning_id' => 2,
                'created_at' => '2020-02-17 20:20:36',
                'updated_at' => '2020-02-17 20:20:36',
            ),
            4 => 
            array (
                'id' => 12,
                'user_id' => 2,
                'warning_id' => 1,
                'created_at' => '2020-02-17 20:20:36',
                'updated_at' => '2020-02-17 20:20:36',
            ),
            5 => 
            array (
                'id' => 13,
                'user_id' => 2,
                'warning_id' => 7,
                'created_at' => '2020-02-17 20:20:36',
                'updated_at' => '2020-02-17 20:20:36',
            ),
            6 => 
            array (
                'id' => 14,
                'user_id' => 4,
                'warning_id' => 7,
                'created_at' => '2020-02-17 20:20:36',
                'updated_at' => '2020-02-17 20:20:36',
            ),
            7 => 
            array (
                'id' => 15,
                'user_id' => 2,
                'warning_id' => 8,
                'created_at' => '2020-02-17 20:20:36',
                'updated_at' => '2020-02-17 20:20:36',
            ),
            8 => 
            array (
                'id' => 16,
                'user_id' => 4,
                'warning_id' => 8,
                'created_at' => '2020-02-17 20:20:36',
                'updated_at' => '2020-02-17 20:20:36',
            ),
            9 => 
            array (
                'id' => 17,
                'user_id' => 2,
                'warning_id' => 9,
                'created_at' => '2020-02-17 20:20:36',
                'updated_at' => '2020-02-17 20:20:36',
            ),
            10 => 
            array (
                'id' => 18,
                'user_id' => 4,
                'warning_id' => 9,
                'created_at' => '2020-02-17 20:20:36',
                'updated_at' => '2020-02-17 20:20:36',
            ),
            11 => 
            array (
                'id' => 19,
                'user_id' => 2,
                'warning_id' => 10,
                'created_at' => '2020-02-17 20:20:36',
                'updated_at' => '2020-02-17 20:20:36',
            ),
            12 => 
            array (
                'id' => 20,
                'user_id' => 1,
                'warning_id' => 6,
                'created_at' => '2020-02-17 20:20:36',
                'updated_at' => '2020-02-17 20:20:36',
            ),
            13 => 
            array (
                'id' => 21,
                'user_id' => 1,
                'warning_id' => 2,
                'created_at' => '2020-02-17 20:20:36',
                'updated_at' => '2020-02-17 20:20:36',
            ),
            14 => 
            array (
                'id' => 22,
                'user_id' => 1,
                'warning_id' => 1,
                'created_at' => '2020-02-17 20:20:36',
                'updated_at' => '2020-02-17 20:20:36',
            ),
            15 => 
            array (
                'id' => 23,
                'user_id' => 2,
                'warning_id' => 11,
                'created_at' => '2020-02-17 20:20:36',
                'updated_at' => '2020-02-17 20:20:36',
            ),
            16 => 
            array (
                'id' => 24,
                'user_id' => 1,
                'warning_id' => 12,
                'created_at' => '2020-02-17 20:20:36',
                'updated_at' => '2020-02-17 20:20:36',
            ),
            17 => 
            array (
                'id' => 25,
                'user_id' => 2,
                'warning_id' => 12,
                'created_at' => '2020-02-17 20:20:36',
                'updated_at' => '2020-02-17 20:20:36',
            ),
            18 => 
            array (
                'id' => 26,
                'user_id' => 12,
                'warning_id' => 13,
                'created_at' => '2020-02-17 20:20:36',
                'updated_at' => '2020-02-17 20:20:36',
            ),
            19 => 
            array (
                'id' => 27,
                'user_id' => 19,
                'warning_id' => 13,
                'created_at' => '2020-02-17 20:20:36',
                'updated_at' => '2020-02-17 20:20:36',
            ),
            20 => 
            array (
                'id' => 28,
                'user_id' => 11,
                'warning_id' => 12,
                'created_at' => '2020-02-17 20:20:36',
                'updated_at' => '2020-02-17 20:20:36',
            ),
            21 => 
            array (
                'id' => 29,
                'user_id' => 11,
                'warning_id' => 11,
                'created_at' => '2020-02-17 20:20:36',
                'updated_at' => '2020-02-17 20:20:36',
            ),
            22 => 
            array (
                'id' => 30,
                'user_id' => 11,
                'warning_id' => 10,
                'created_at' => '2020-02-17 20:20:36',
                'updated_at' => '2020-02-17 20:20:36',
            ),
        ));
    }
}
