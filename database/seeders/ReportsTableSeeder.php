<?php

namespace Database\Seeders;
use DB;
use Illuminate\Database\Seeder;
class ReportsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('reports')->delete();
        
        \DB::table('reports')->insert(array (
            0 => 
            array (
                'id' => 1,
                'event_id' => 14,
                'report' => 'Apertura del expediente de Oliver Pata, se presenta con sistomas de defensas bajas , se solicitan analiticas para evaluar su estado.
',
                'absence' => 0,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ),
            1 => 
            array (
                'id' => 2,
                'event_id' => 17,
                'report' => 'Paciente con VIH, e presenta con extraños síntomas',
                'absence' => 0,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ),
            2 => 
            array (
                'id' => 6,
                'event_id' => 27,
                'report' => 'Hola que haces%3F %2A Editado%0A%0A',
                'absence' => 1,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ),
            3 => 
            array (
                'id' => 7,
                'event_id' => 30,
                'report' => 'Este informe es el nuevo%2C pero no se ha dado por finalizado aun.%0A%0AEl paciente posee unos valores de la analitica bastante correctos y no necesita cambio de medicacion. La cambiooooo',
                'absence' => 0,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ),
            4 => 
            array (
                'id' => 8,
                'event_id' => 32,
                'report' => '',
                'absence' => 0,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ),
            5 => 
            array (
                'id' => 9,
                'event_id' => 31,
                'report' => '',
                'absence' => 1,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ),
            6 => 
            array (
                'id' => 10,
                'event_id' => 33,
                'report' => '',
                'absence' => 0,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ),
            7 => 
            array (
                'id' => 11,
                'event_id' => 35,
                'report' => '',
                'absence' => 0,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ),
            8 => 
            array (
                'id' => 12,
                'event_id' => 39,
                'report' => '',
                'absence' => 0,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ),
            9 => 
            array (
                'id' => 13,
                'event_id' => 50,
                'report' => '',
                'absence' => 0,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ),
            10 => 
            array (
                'id' => 14,
                'event_id' => 51,
                'report' => '',
                'absence' => 0,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ),
            11 => 
            array (
                'id' => 15,
                'event_id' => 54,
                'report' => '',
                'absence' => 0,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ),
            12 => 
            array (
                'id' => 16,
                'event_id' => 56,
                'report' => '',
                'absence' => 0,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ),
            13 => 
            array (
                'id' => 17,
                'event_id' => 57,
                'report' => '',
                'absence' => 0,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ),
            14 => 
            array (
                'id' => 18,
                'event_id' => 59,
                'report' => '',
                'absence' => 1,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ),
            15 => 
            array (
                'id' => 19,
                'event_id' => 58,
                'report' => 'Este es el nuevo informe de la consulta',
                'absence' => 0,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ),
            16 => 
            array (
                'id' => 20,
                'event_id' => 60,
                'report' => '',
                'absence' => 0,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ),
            17 => 
            array (
                'id' => 21,
                'event_id' => 61,
                'report' => '',
                'absence' => 0,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ),
            18 => 
            array (
                'id' => 24,
                'event_id' => 66,
                'report' => 'test',
                'absence' => 0,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ),
            19 => 
            array (
                'id' => 25,
                'event_id' => 67,
                'report' => 'Primera visita correcta',
                'absence' => 0,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ),
        ));
        
        
    }
}