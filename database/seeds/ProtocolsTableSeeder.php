<?php

use Illuminate\Database\Seeder;

class ProtocolsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('protocols')->delete();
        
        \DB::table('protocols')->insert(array (
            0 => 
            array (
                'id' => 1,
                'user_id_creator' => 2,
                'user_id_user' => 10,
                'name' => 'Inicio Tratamiento',
                'deleted_at' => null,
                'created_at' => '2020-02-17 20:18:00',
                'updated_at' => '2020-02-17 20:18:00',
            ),
            1 => 
            array (
                'id' => 2,
                'user_id_creator' => 2,
                'user_id_user' => 10,
                'name' => 'Fase inicial',
                'deleted_at' => null,
                'created_at' => '2020-02-17 20:18:00',
                'updated_at' => '2020-02-17 20:18:00',
            ),
            2 => 
            array (
                'id' => 3,
                'user_id_creator' => 2,
                'user_id_user' => 10,
                'name' => 'Fase 33',
                'deleted_at' => date("Y-m-d H:i:s"),
                'created_at' => '2020-02-17 20:18:00',
                'updated_at' => '2020-02-17 20:18:00',
            ),
            3 => 
            array (
                'id' => 4,
                'user_id_creator' => 2,
                'user_id_user' => 10,
                'name' => 'Fase 4',
                'deleted_at' => date("Y-m-d H:i:s"),
                'created_at' => '2020-02-17 20:18:00',
                'updated_at' => '2020-02-17 20:18:00',
            ),
            4 => 
            array (
                'id' => 6,
                'user_id_creator' => 2,
                'user_id_user' => 10,
                'name' => 'Fase 5',
                'deleted_at' => date("Y-m-d H:i:s"),
                'created_at' => '2020-02-17 20:18:00',
                'updated_at' => '2020-02-17 20:18:00',
            ),
            5 => 
            array (
                'id' => 8,
                'user_id_creator' => 2,
                'user_id_user' => 10,
                'name' => 'Fase 6',
                'deleted_at' => date("Y-m-d H:i:s"),
                'created_at' => '2020-02-17 20:18:00',
                'updated_at' => '2020-02-17 20:18:00',
            ),
            6 => 
            array (
                'id' => 9,
                'user_id_creator' => 2,
                'user_id_user' => 10,
                'name' => 'Fase 7',
                'deleted_at' => date("Y-m-d H:i:s"),
                'created_at' => '2020-02-17 20:18:00',
                'updated_at' => '2020-02-17 20:18:00',
            ),
            7 => 
            array (
                'id' => 10,
                'user_id_creator' => 2,
                'user_id_user' => 4,
                'name' => 'Inicio Sesiones',
                'deleted_at' => null,
                'created_at' => '2020-02-17 20:18:00',
                'updated_at' => '2020-02-17 20:18:00',
            ),
            8 => 
            array (
                'id' => 15,
                'user_id_creator' => 2,
                'user_id_user' => 10,
                'name' => 'Fase 6',
                'deleted_at' => date("Y-m-d H:i:s"),
                'created_at' => '2020-02-17 20:18:00',
                'updated_at' => '2020-02-17 20:18:00',
            ),
            9 => 
            array (
                'id' => 16,
                'user_id_creator' => 2,
                'user_id_user' => 10,
                'name' => 'Test',
                'deleted_at' => date("Y-m-d H:i:s"),
                'created_at' => '2020-02-17 20:18:00',
                'updated_at' => '2020-02-17 20:18:00',
            ),
            10 => 
            array (
                'id' => 17,
                'user_id_creator' => 2,
                'user_id_user' => 10,
                'name' => 'Newwww',
                'deleted_at' => date("Y-m-d H:i:s"),
                'created_at' => '2020-02-17 20:18:00',
                'updated_at' => '2020-02-17 20:18:00',
            ),
            11 => 
            array (
                'id' => 18,
                'user_id_creator' => 12,
                'user_id_user' => 19,
                'name' => 'Fase 1',
                'deleted_at' => null,
                'created_at' => '2020-02-17 20:18:00',
                'updated_at' => '2020-02-17 20:18:00',
            ),
            12 => 
            array (
                'id' => 19,
                'user_id_creator' => 2,
                'user_id_user' => 10,
                'name' => 'fin',
                'deleted_at' => null,
                'created_at' => '2020-02-17 20:18:00',
                'updated_at' => '2020-02-17 20:18:00',
            ),
        ));
        
        
    }
}