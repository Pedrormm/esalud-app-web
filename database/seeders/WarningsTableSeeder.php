<?php

namespace Database\Seeders;
use DB;
use Illuminate\Database\Seeder;
class WarningsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('warnings')->delete();
        
        \DB::table('warnings')->insert(array (
            0 => 
            array (
                'id' => 1,
                'user_id_creator' => 1,
                'user_id_patient' => 4,
                'text' => 'Es así',
                'scope' => 234,
                'deleted_at' => null,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ),
            1 => 
            array (
                'id' => 2,
                'user_id_creator' => 1,
                'user_id_patient' => 4,
            'text' => 'No obedece',
                'scope' => 234,
                'deleted_at' => null,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ),
            2 => 
            array (
                'id' => 3,
                'user_id_creator' => 2,
                'user_id_patient' => 4,
                'text' => 'No se toma la medicación',
                'scope' => 2,
                'deleted_at' => date("Y-m-d H:i:s"),
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ),
            3 => 
            array (
                'id' => 4,
                'user_id_creator' => 2,
                'user_id_patient' => 4,
                'text' => 'Más raro que un perro verde',
                'scope' => 23,
                'deleted_at' => date("Y-m-d H:i:s"),
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ),
            4 => 
            array (
                'id' => 5,
                'user_id_creator' => 2,
                'user_id_patient' => 4,
                'text' => 'Prueba',
                'scope' => 23,
                'deleted_at' => date("Y-m-d H:i:s"),
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ),
            5 => 
            array (
                'id' => 6,
                'user_id_creator' => 2,
                'user_id_patient' => 4,
                'text' => 'No está bien',
                'scope' => 4,
                'deleted_at' => null,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ),
            6 => 
            array (
                'id' => 7,
                'user_id_creator' => 2,
                'user_id_patient' => 4,
                'text' => 'Eres así',
                'scope' => 1,
                'deleted_at' => date("Y-m-d H:i:s"),
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ),
            7 => 
            array (
                'id' => 8,
                'user_id_creator' => 2,
                'user_id_patient' => 4,
                'text' => 'Hola',
                'scope' => 1,
                'deleted_at' => null,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ),
            8 => 
            array (
                'id' => 9,
                'user_id_creator' => 2,
                'user_id_patient' => 4,
                'text' => 'Aviso de urgencia',
                'scope' => 12,
                'deleted_at' => date("Y-m-d H:i:s"),
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ),
            9 => 
            array (
                'id' => 10,
                'user_id_creator' => 2,
                'user_id_patient' => 10,
                'text' => 'Revisar siempre su tarjeta sanitaria',
                'scope' => 2,
                'deleted_at' => null,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ),
            10 => 
            array (
                'id' => 11,
                'user_id_creator' => 2,
                'user_id_patient' => 10,
                'text' => 'Avisar resultados positivos analíticas',
                'scope' => 2,
                'deleted_at' => null,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ),
            11 => 
            array (
                'id' => 12,
                'user_id_creator' => 1,
                'user_id_patient' => 10,
                'text' => 'Revisar analíticas',
                'scope' => 2,
                'deleted_at' => null,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ),
            12 => 
            array (
                'id' => 13,
                'user_id_creator' => 12,
                'user_id_patient' => 19,
                'text' => 'Bienvenido a tu historial',
                'scope' => 1,
                'deleted_at' => null,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ),
        ));
        
        
    }
}