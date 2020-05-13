<?php

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
            'text' => 'Implemente texto aleatorio. Tiene sus raices en una pieza clásica de la literatura del Latin, que data del año 45 antes de Cristo, haciendo que este adquiera mas de 2000 años de antiguedad. Richard McClintock, un profesor de Latin de la Universidad de Hampden-Sydney en Virginia, encontró una de las palabras más oscuras de la lengua del latín, "consecteur", en un pasaje de Lorem Ipsum, y al seguir leyendo distintos textos del latín, descubrió la fuente indudable. Lorem Ipsum viene de las secciones 1.10.32 y 1.10.33 de "de Finnibus Bonorum et Malorum" (Los Extremos del Bien y El Mal) por Cicero, escrito en el año 45 antes de Cristo. Este libro es un tratado de teoría de éticas, muy popular durante el Renacimiento. La primera linea del Lorem Ipsum, "Lorem ipsum dolor sit amet..", viene de una linea en la sección 1.10.32

El trozo de texto estándar de Lorem Ipsum usado desde el año 1500 es reproducido debajo para aquellos interesados. Las secciones 1.10.32 y 1.10.33 de "de Finibus Bonorum et Malorum" por Cicero son también reproducidas en su forma original exacta, acompañadas por versiones en Inglés de la traducción realizada en 1914 por H. Rackham.',
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