<?php

namespace Database\Seeders;
use DB;
use Illuminate\Database\Seeder;
class NotesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('notes')->delete();
        
        \DB::table('notes')->insert(array (
            0 => 
            array (
                'id' => 1,
                'user_id' => 4,
                'text' => '',
                'event' => 11,
                'visible' => 0,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ),
            1 => 
            array (
                'id' => 2,
                'user_id' => 4,
                'text' => 'asdasd',
                'event' => 11,
                'visible' => 0,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ),
            2 => 
            array (
                'id' => 4,
                'user_id' => 10,
                'text' => 'Esta nota quiero que la lea mi médico, para poder saber como estoy. Atentamente, Pedro',
                'event' => 17,
                'visible' => 1,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ),
            3 => 
            array (
                'id' => 5,
                'user_id' => 10,
                'text' => 'asdasdasd',
                'event' => 18,
                'visible' => 1,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ),
            4 => 
            array (
                'id' => 6,
                'user_id' => 10,
                'text' => 'Pregunta por medicación',
                'event' => 24,
                'visible' => 1,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ),
            5 => 
            array (
                'id' => 7,
                'user_id' => 5,
                'text' => 'No me encuentro bien',
                'event' => 32,
                'visible' => 1,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ),
            6 => 
            array (
                'id' => 8,
                'user_id' => 10,
                'text' => 'Hola esto es una prueba',
                'event' => 58,
                'visible' => 1,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ),
        ));
        
        
    }
}