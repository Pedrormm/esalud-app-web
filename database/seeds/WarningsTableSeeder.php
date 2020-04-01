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
                'text' => 'Es muuuuuuuu tonto',
                'scope' => 234,
                'deleted_at' => null,
                'created_at' => '2020-02-17 20:20:25',
                'updated_at' => '2020-02-17 20:20:25',
            ),
            1 => 
            array (
                'id' => 2,
                'user_id_creator' => 1,
                'user_id_patient' => 4,
            'text' => 'implemente texto aleatorio. Tiene sus raices en una pieza cl´sica de la literatura del Latin, que data del año 45 antes de Cristo, haciendo que este adquiera mas de 2000 años de antiguedad. Richard McClintock, un profesor de Latin de la Universidad de Hampden-Sydney en Virginia, encontró una de las palabras más oscuras de la lengua del latín, "consecteur", en un pasaje de Lorem Ipsum, y al seguir leyendo distintos textos del latín, descubrió la fuente indudable. Lorem Ipsum viene de las secciones 1.10.32 y 1.10.33 de "de Finnibus Bonorum et Malorum" (Los Extremos del Bien y El Mal) por Cicero, escrito en el año 45 antes de Cristo. Este libro es un tratado de teoría de éticas, muy popular durante el Renacimiento. La primera linea del Lorem Ipsum, "Lorem ipsum dolor sit amet..", viene de una linea en la sección 1.10.32

El trozo de texto estándar de Lorem Ipsum usado desde el año 1500 es reproducido debajo para aquellos interesados. Las secciones 1.10.32 y 1.10.33 de "de Finibus Bonorum et Malorum" por Cicero son también reproducidas en su forma original exacta, acompañadas por versiones en Inglés de la traducción realizada en 1914 por H. Rackham.',
                'scope' => 234,
                'deleted_at' => null,
                'created_at' => '2020-02-17 20:20:25',
                'updated_at' => '2020-02-17 20:20:25',
            ),
            2 => 
            array (
                'id' => 3,
                'user_id_creator' => 2,
                'user_id_patient' => 4,
                'text' => 'No se toma la medicacion',
                'scope' => 2,
                'deleted_at' => date("Y-m-d H:i:s"),
                'created_at' => '2020-02-17 20:20:25',
                'updated_at' => '2020-02-17 20:20:25',
            ),
            3 => 
            array (
                'id' => 4,
                'user_id_creator' => 2,
                'user_id_patient' => 4,
                'text' => 'Mas raro que un perro verde',
                'scope' => 23,
                'deleted_at' => date("Y-m-d H:i:s"),
                'created_at' => '2020-02-17 20:20:25',
                'updated_at' => '2020-02-17 20:20:25',
            ),
            4 => 
            array (
                'id' => 5,
                'user_id_creator' => 2,
                'user_id_patient' => 4,
                'text' => 'Prueba',
                'scope' => 23,
                'deleted_at' => date("Y-m-d H:i:s"),
                'created_at' => '2020-02-17 20:20:25',
                'updated_at' => '2020-02-17 20:20:25',
            ),
            5 => 
            array (
                'id' => 6,
                'user_id_creator' => 2,
                'user_id_patient' => 4,
                'text' => 'No esta bien',
                'scope' => 4,
                'deleted_at' => null,
                'created_at' => '2020-02-17 20:20:25',
                'updated_at' => '2020-02-17 20:20:25',
            ),
            6 => 
            array (
                'id' => 7,
                'user_id_creator' => 2,
                'user_id_patient' => 4,
                'text' => 'Eres así',
                'scope' => 1,
                'deleted_at' => date("Y-m-d H:i:s"),
                'created_at' => '2020-02-17 20:20:25',
                'updated_at' => '2020-02-17 20:20:25',
            ),
            7 => 
            array (
                'id' => 8,
                'user_id_creator' => 2,
                'user_id_patient' => 4,
                'text' => 'Hola',
                'scope' => 1,
                'deleted_at' => null,
                'created_at' => '2020-02-17 20:20:25',
                'updated_at' => '2020-02-17 20:20:25',
            ),
            8 => 
            array (
                'id' => 9,
                'user_id_creator' => 2,
                'user_id_patient' => 4,
                'text' => 'Aviso de urgencia',
                'scope' => 12,
                'deleted_at' => date("Y-m-d H:i:s"),
                'created_at' => '2020-02-17 20:20:25',
                'updated_at' => '2020-02-17 20:20:25',
            ),
            9 => 
            array (
                'id' => 10,
                'user_id_creator' => 2,
                'user_id_patient' => 10,
                'text' => 'Revisar siempre su tarjeta sanitaria',
                'scope' => 2,
                'deleted_at' => null,
                'created_at' => '2020-02-17 20:20:25',
                'updated_at' => '2020-02-17 20:20:25',
            ),
            10 => 
            array (
                'id' => 11,
                'user_id_creator' => 2,
                'user_id_patient' => 10,
                'text' => 'Avisar resultados positivos analiticas',
                'scope' => 2,
                'deleted_at' => null,
                'created_at' => '2020-02-17 20:20:25',
                'updated_at' => '2020-02-17 20:20:25',
            ),
            11 => 
            array (
                'id' => 12,
                'user_id_creator' => 1,
                'user_id_patient' => 10,
                'text' => 'Revisar analiticas',
                'scope' => 2,
                'deleted_at' => null,
                'created_at' => '2020-02-17 20:20:25',
                'updated_at' => '2020-02-17 20:20:25',
            ),
            12 => 
            array (
                'id' => 13,
                'user_id_creator' => 12,
                'user_id_patient' => 19,
                'text' => 'Bienvenido a tu historial',
                'scope' => 1,
                'deleted_at' => null,
                'created_at' => '2020-02-17 20:20:25',
                'updated_at' => '2020-02-17 20:20:25',
            ),
        ));
        
        
    }
}