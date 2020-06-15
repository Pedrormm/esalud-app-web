<?php

use Illuminate\Database\Seeder;

class MessagesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('messages')->delete();
        
        \DB::table('messages')->insert(array (
            0 => 
            array (
                'id' => 1,
                'user_id_from' => 1,
                'user_id_to' => 5,
                'message' => 'Buenos dias Laura.',
                'read' => true,
                'created_at' => '2020-02-17 20:16:47',
                'updated_at' => '2020-03-09 23:21:51',
            ),
            1 => 
            array (
                'id' => 2,
                'user_id_from' => 1,
                'user_id_to' => 5,
                'message' => 'Te voy a comentar como han ido los resultados de tu ultima prueba:
- 1351.13541
- 6324.1351
-3587.232',
                'read' => true,
                'created_at' => '2020-02-17 20:20:47',
                'updated_at' => '2020-03-09 23:21:51',
            ),
            2 => 
            array (
                'id' => 3,
                'user_id_from' => 1,
                'user_id_to' => 5,
                'message' => 'Con esto quiero decir que son buenos',
                'read' => true,
                'created_at' => '2020-02-17 20:18:47',
                'updated_at' => '2020-03-09 23:21:51',
            ),
            3 => 
            array (
                'id' => 4,
                'user_id_from' => 1,
                'user_id_to' => 5,
                'message' => 'Adios',
                'read' => false,
                'created_at' => '2020-02-17 20:16:49',
                'updated_at' => '2020-03-09 01:00:58',
            ),
            4 => 
            array (
                'id' => 5,
                'user_id_from' => 1,
                'user_id_to' => 5,
                'message' => 'de nada',
                'read' => false,
                'created_at' => '2020-02-17 20:16:46',
                'updated_at' => '2020-03-09 23:21:51',
            ),
            5 => 
            array (
                'id' => 6,
                'user_id_from' => 5,
                'user_id_to' => 1,
                'message' => 'Muchas gracias por todo.
Un saludo',
                'read' => true,
                'created_at' => '2020-02-17 20:17:47',
                'updated_at' => '2020-03-09 23:21:51',
            ),
            6 => 
            array (
                'id' => 7,
                'user_id_from' => 14,
                'user_id_to' => 1,
                'message' => 'No tengo conocimiento sobre ese contacto indicado. Muchas gracias.',
                'read' => true,
                'created_at' => '2020-02-17 20:16:47',
                'updated_at' => '2020-03-07 02:35:59',
            ),
            7 => 
            array (
                'id' => 8,
                'user_id_from' => 5,
                'user_id_to' => 1,
                'message' => 'aaaaaa',
                'read' => false,
                'created_at' => '2020-02-17 20:16:47',
                'updated_at' => '2020-03-04 18:56:58',
            ),
            8 => 
            array (
                'id' => 9,
                'user_id_from' => 5,
                'user_id_to' => 2,
                'message' => 'prueba',
                'read' => true,
                'created_at' => '2020-02-17 20:16:47',
                'updated_at' => '2020-02-17 20:16:47',
            ),
            9 => 
            array (
                'id' => 10,
                'user_id_from' => 5,
                'user_id_to' => 1,
                'message' => 'Hola Pedro. Soy Laura Sánchez. 

Me pongo en contacto contigo porque nos han comentado sobre los problemas que has experimentado últimamente dentro de nuestra app. 

Lamentamos que te hayas encontrado con estos problemas. 

Me gustaría saber más sobre ellos. 

Un saludo.',
                'read' => true,
                'created_at' => '2020-02-17 20:16:47',
                'updated_at' => '2020-03-07 02:35:01',
            ),
            10 => 
            array (
                'id' => 11,
                'user_id_from' => 5,
                'user_id_to' => 1,
                'message' => 'mas',
                'read' => true,
                'created_at' => '2020-02-17 20:16:47',
                'updated_at' => '2020-02-17 20:16:47',
            ),
            11 => 
            array (
                'id' => 12,
                'user_id_from' => 1,
                'user_id_to' => 10,
                'message' => 'Hola oliver',
                'read' => true,
                'created_at' => '2020-02-17 20:16:47',
                'updated_at' => '2020-03-09 23:21:51',
            ),
            12 => 
            array (
                'id' => 13,
                'user_id_from' => 1,
                'user_id_to' => 5,
                'message' => 'Como va el dia?',
                'read' => false,
                'created_at' => '2020-02-17 20:16:47',
                'updated_at' => '2020-03-09 23:21:51',
            ),
            13 => 
            array (
                'id' => 14,
                'user_id_from' => 5,
                'user_id_to' => 1,
                'message' => 'Noticia importante de lectura obligatoria para todos los trabajadores',
                'read' => true,
                'created_at' => '2020-02-17 20:16:47',
                'updated_at' => '2020-02-17 20:16:47',
            ),
            14 => 
            array (
                'id' => 15,
                'user_id_from' => 1,
                'user_id_to' => 3,
                'message' => 'Hola, da cita a pepe',
                'read' => true,
                'created_at' => '2020-02-17 20:16:47',
                'updated_at' => '2020-03-09 23:21:51',
            ),
            15 => 
            array (
                'id' => 16,
                'user_id_from' => 1,
                'user_id_to' => 11,
                'message' => 'Necesito tu ayuda en 5 minutos',
                'read' => false,
                'created_at' => '2020-02-17 20:16:47',
                'updated_at' => '2020-03-09 23:21:51',
            ),
            16 => 
            array (
                'id' => 17,
                'user_id_from' => 1,
                'user_id_to' => 14,
                'message' => 'Hola',
                'read' => true,
                'created_at' => '2020-02-17 20:16:47',
                'updated_at' => '2020-02-17 20:16:47',
            ),
            17 => 
            array (
                'id' => 18,
                'user_id_from' => 14,
                'user_id_to' => 1,
                'message' => 'Gracias por la ayuda',
                'read' => true,
                'created_at' => '2020-02-17 20:16:47',
                'updated_at' => '2020-02-17 20:16:47',
            ),
            18 => 
            array (
                'id' => 19,
                'user_id_from' => 1,
                'user_id_to' => 2,
                'message' => 'Hola',
                'read' => true,
                'created_at' => '2020-02-17 20:16:47',
                'updated_at' => '2020-02-17 20:16:47',
            ),
            19 => 
            array (
                'id' => 20,
                'user_id_from' => 1,
                'user_id_to' => 2,
                'message' => 'Esto es una prueba del chat',
                'read' => true,
                'created_at' => '2020-02-17 20:16:47',
                'updated_at' => '2020-03-09 23:21:51',
            ),
            20 => 
            array (
                'id' => 21,
                'user_id_from' => 1,
                'user_id_to' => 2,
                'message' => 'Y para saber si te llegan los mensajes mios',
                'read' => true,
                'created_at' => '2020-02-17 20:16:47',
                'updated_at' => '2020-03-09 23:21:51',
            ),
            21 => 
            array (
                'id' => 22,
                'user_id_from' => 2,
                'user_id_to' => 1,
                'message' => 'Hola',
                'read' => true,
                'created_at' => '2020-02-17 20:16:47',
                'updated_at' => '2020-02-17 20:16:47',
            ),
            22 => 
            array (
                'id' => 23,
                'user_id_from' => 2,
                'user_id_to' => 1,
                'message' => 'Mas',
                'read' => true,
                'created_at' => '2020-02-17 20:16:47',
                'updated_at' => '2020-02-17 20:16:47',
            ),
            23 => 
            array (
                'id' => 24,
                'user_id_from' => 2,
                'user_id_to' => 1,
                'message' => 'Que tal?',
                'read' => true,
                'created_at' => '2020-02-17 20:16:47',
                'updated_at' => '2020-03-09 23:21:51',
            ),
            24 => 
            array (
                'id' => 25,
                'user_id_from' => 2,
                'user_id_to' => 4,
                'message' => 'Buenas tardes Maria',
                'read' => true,
                'created_at' => '2020-02-17 20:16:47',
                'updated_at' => '2020-03-09 23:21:51',
            ),
            25 => 
            array (
                'id' => 26,
                'user_id_from' => 10,
                'user_id_to' => 2,
                'message' => 'Hola Doctor',
                'read' => true,
                'created_at' => '2020-02-17 20:16:47',
                'updated_at' => '2020-03-09 23:21:51',
            ),
            26 => 
            array (
                'id' => 27,
                'user_id_from' => 1,
                'user_id_to' => 2,
                'message' => 'adasd',
                'read' => true,
                'created_at' => '2020-02-17 20:16:47',
                'updated_at' => '2020-02-17 20:16:47',
            ),
            27 => 
            array (
                'id' => 28,
                'user_id_from' => 1,
                'user_id_to' => 2,
                'message' => 'a',
                'read' => true,
                'created_at' => '2020-02-17 20:16:47',
                'updated_at' => '2020-02-17 20:16:47',
            ),
            28 => 
            array (
                'id' => 29,
                'user_id_from' => 4,
                'user_id_to' => 2,
                'message' => 'Hola , tengo una pregunta',
                'read' => true,
                'created_at' => '2020-02-17 20:16:47',
                'updated_at' => '2020-03-09 23:21:51',
            ),
            29 => 
            array (
                'id' => 30,
                'user_id_from' => 10,
                'user_id_to' => 2,
                'message' => 'Prueba',
                'read' => false,
                'created_at' => '2020-02-17 20:16:47',
                'updated_at' => '2020-02-17 20:16:47',
            ),
            30 => 
            array (
                'id' => 31,
                'user_id_from' => 10,
                'user_id_to' => 2,
                'message' => 'necesito ayuda',
                'read' => false,
                'created_at' => '2020-02-17 20:16:47',
                'updated_at' => '2020-03-09 23:21:51',
            ),
            31 => 
            array (
                'id' => 32,
                'user_id_from' => 2,
                'user_id_to' => 1,
                'message' => 'Hola',
                'read' => true,
                'created_at' => '2020-02-17 20:16:47',
                'updated_at' => '2020-02-17 20:16:47',
            ),
            32 => 
            array (
                'id' => 33,
                'user_id_from' => 2,
                'user_id_to' => 1,
                'message' => 'test',
                'read' => true,
                'created_at' => '2020-02-17 20:16:47',
                'updated_at' => '2020-02-17 20:16:47',
            ),
            33 => 
            array (
                'id' => 34,
                'user_id_from' => 2,
                'user_id_to' => 1,
                'message' => 'otro mensaje',
                'read' => true,
                'created_at' => '2020-02-17 20:16:47',
                'updated_at' => '2020-03-09 23:21:51',
            ),
            34 => 
            array (
                'id' => 35,
                'user_id_from' => 2,
                'user_id_to' => 1,
                'message' => 'y otro mas',
                'read' => true,
                'created_at' => '2020-02-17 20:16:47',
                'updated_at' => '2020-03-09 23:21:51',
            ),
            35 => 
            array (
                'id' => 36,
                'user_id_from' => 2,
                'user_id_to' => 1,
                'message' => 'Me funciona muy bien esto',
                'read' => true,
                'created_at' => '2020-02-17 20:16:47',
                'updated_at' => '2020-03-09 23:21:51',
            ),
            36 => 
            array (
                'id' => 37,
                'user_id_from' => 1,
                'user_id_to' => 2,
                'message' => 'Buenos dias , tenemos que tener una reunion la semana que viene. ¿Que dia te viene mejor?',
                'read' => true,
                'created_at' => '2020-02-17 20:16:47',
                'updated_at' => '2020-03-09 23:21:51',
            ),
            37 => 
            array (
                'id' => 38,
                'user_id_from' => 2,
                'user_id_to' => 1,
                'message' => 'Hola',
                'read' => true,
                'created_at' => '2020-02-17 20:16:47',
                'updated_at' => '2020-02-17 20:16:47',
            ),
            38 => 
            array (
                'id' => 39,
                'user_id_from' => 2,
                'user_id_to' => 1,
                'message' => 'Creo que cuando mejor podre es el miércoles o jueves por la tarde',
                'read' => true,
                'created_at' => '2020-02-17 20:16:47',
                'updated_at' => '2020-03-09 23:21:51',
            ),
            39 => 
            array (
                'id' => 40,
                'user_id_from' => 2,
                'user_id_to' => 1,
                'message' => 'A partir de las 19:00 me vendría bien',
                'read' => true,
                'created_at' => '2020-02-17 20:16:47',
                'updated_at' => '2020-03-09 23:21:51',
            ),
            40 => 
            array (
                'id' => 41,
                'user_id_from' => 1,
                'user_id_to' => 2,
                'message' => 'Vale perfecto. Quedamos entonces el miercoles a esa hora',
                'read' => false,
                'created_at' => '2020-02-17 20:16:47',
                'updated_at' => '2020-03-09 23:21:51',
            ),
            41 => 
            array (
                'id' => 42,
                'user_id_from' => 1,
                'user_id_to' => 2,
                'message' => 'No vemos',
                'read' => false,
                'created_at' => '2020-02-17 20:16:47',
                'updated_at' => '2020-03-09 23:21:51',
            ),
            42 => 
            array (
                'id' => 43,
                'user_id_from' => 1,
                'user_id_to' => 2,
                'message' => 'Gracuas por todo',
                'read' => false,
                'created_at' => '2020-02-17 20:16:47',
                'updated_at' => '2020-03-09 23:21:51',
            ),
        ));
        
        
    }
}