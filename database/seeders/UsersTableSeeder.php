<?php

namespace Database\Seeders;
use DB;
use Illuminate\Database\Seeder;
class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        DB::table('users')->insert(
            [
                [
                    'id'=>1,
                    'dni'=>'admin',
                    'password'=>\Hash::make("123456"),
                    // 'password'=>'$2y$10$AJ446eQleao9Ti4uzzd.EeCsAA1OZVYQnlb543uAXO6vpjBYrDB7W',
                    'name'=>'Pedro Ramón',
                    'lastname'=>'Moreno Martín',
                    'address'=>'Gloriera Sin nombre 5',
                    'city'=>'Valdemoro',
                    'country'=>'España',
                    'zipcode'=>'28342',
                    'email'=>'pedroramonmm@gmail.com',
                    'phone'=>'646731068',
                    'birthdate'=>'1990-11-14',
                    'avatar'=>NULL,
                    'sex'=>'male',
                    'blood'=>'0+',
                    'role_id'=>4,
                    'remember_token'=>NULL,
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")                  
                ],
                [
                    'id'=>2,
                    'dni'=>'51474497Z',
                    'password'=>\Hash::make("123456"),
                    'name'=>'Juan',
                    'lastname'=>'Chacón Pérez',
                    'address'=>'Plaza de San Eustequio 3',
                    'city'=>'Mostoles',
                    'country'=>'España',
                    'zipcode'=>'28938',
                    'email'=>'pedroramonmmspam1@gmail.com',
                    'phone'=>'666999666',
                    'birthdate'=>'1989-11-01',
                    'avatar'=>NULL,
                    'sex'=>'male',
                    'blood'=>'A+',
                    'role_id'=>2,
                    'remember_token'=>NULL,
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")  
                ],
                [
                    'id'=>3,
                    'dni'=>'00000000T',
                    'password'=>\Hash::make("123456"),
                    'name'=>'David',
                    'lastname'=>'Pérez López',
                    'address'=>'822 Fay Summit Apt. 023',
                    'city'=>'Seoul',
                    'country'=>'Korea',
                    'zipcode'=>'33440',
                    'email'=>'overhere@gmail.com',
                    'phone'=>'190234893',
                    'birthdate'=>'1965-11-25',
                    'avatar'=>NULL,
                    'sex'=>'male',
                    'blood'=>'B-',
                    'role_id'=>3,
                    'remember_token'=>NULL,
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")  
                ],
                [
                    'id'=>4,
                    'dni'=>'11111111H',
                    'password'=>\Hash::make("123456"),
                    'name'=>'María',
                    'lastname'=>'Márquez Muñoz',
                    'address'=>'1686 Kathryne Skyway Apt. 519',
                    'city'=>'Amsterdam',
                    'country'=>'Países Bajos',
                    'zipcode'=>'99023',
                    'email'=>'maria@gmail.com',
                    'phone'=>'650210074',
                    'birthdate'=>'1974-10-05',
                    'avatar'=>NULL,
                    'sex'=>'female',
                    'blood'=>'AB+',
                    'role_id'=>1,
                    'remember_token'=>NULL,
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")  
                ],
                [
                    'id'=>5,
                    'dni'=>'22222222J',
                    'password'=>\Hash::make("123456"),
                    'name'=>'Laura',
                    'lastname'=>'Sánchez Sanz',
                    'address'=>'75251 Russel Islands Apt. 627',
                    'city'=>'Belgrado',
                    'country'=>'Serbia',
                    'zipcode'=>'13323',
                    'email'=>'pedroramonmmspam2@gmail.com',
                    'phone'=>'597393208',
                    'birthdate'=>'1980-01-12',
                    'avatar'=>NULL,
                    'sex'=>'female',
                    'blood'=>'0+',
                    'role_id'=>1,
                    'remember_token'=>NULL,
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")  
                ],
                [
                    'id'=>6,
                    'dni'=>'44444444A',
                    'password'=>\Hash::make("123456"),
                    'name'=>'Pedro',
                    'lastname'=>'Rodríguez Cano',
                    'address'=>'Calle murcia 55',
                    'city'=>'Mostoles',
                    'country'=>'España',
                    'zipcode'=>'24938',
                    'email'=>'pedro_rmm@hotmail.es',
                    'phone'=>'666222547',
                    'birthdate'=>'1966-01-20',
                    'avatar'=>NULL,
                    'sex'=>'male',
                    'blood'=>'AB+',
                    'role_id'=>1,
                    'remember_token'=>NULL,
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")  
                ],
                [
                    'id'=>7,
                    'dni'=>'55555555K',
                    'password'=>\Hash::make("123456"),
                    'name'=>'Susana',
                    'lastname'=>'Braga Palomino',
                    'address'=>'Calle Jones Spur 2',
                    'city'=>'Mostoles',
                    'country'=>'España',
                    'zipcode'=>'21234',
                    'email'=>'braurittunauda-4128@yopmail.com',
                    'phone'=>'666999666',
                    'birthdate'=>'1999-01-20',
                    'avatar'=>NULL,
                    'sex'=>'female',
                    'blood'=>'A+',
                    'role_id'=>2,
                    'remember_token'=>NULL,
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")  
                ],
                [
                    'id'=>8,
                    'dni'=>'66666666Q',
                    'password'=>\Hash::make("123456"),
                    'name'=>'Augusto',
                    'lastname'=>'Bragueta Suelta',
                    'address'=>'Avenida de las Iglesias 14',
                    'city'=>'Cúcuta',
                    'country'=>'Colombia',
                    'zipcode'=>'25938',
                    'email'=>'dacreugreimeme-9179@yopmail.com',
                    'phone'=>'666999666',
                    'birthdate'=>'1939-12-21',
                    'avatar'=>NULL,
                    'sex'=>'male',
                    'blood'=>'A+',
                    'role_id'=>5,
                    'remember_token'=>NULL,
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")  
                ],
                [
                    'id'=>9,
                    'dni'=>'77777777B',
                    'password'=>\Hash::make("123456"),
                    'name'=>'Agustín',
                    'lastname'=>'Cabeza Compostizo',
                    'address'=>'Calle Cabeza 4',
                    'city'=>'Cádiz',
                    'country'=>'España',
                    'zipcode'=>'28768',
                    'email'=>'gradessuproqua-6162@yopmail.com',
                    'phone'=>'666999666',
                    'birthdate'=>'2004-05-02',
                    'avatar'=>NULL,
                    'sex'=>'male',
                    'blood'=>'A+',
                    'role_id'=>5,
                    'remember_token'=>NULL,
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")  
                ],
                [
                    'id'=>10,
                    'dni'=>'88888888Y',
                    'password'=>\Hash::make("123456"),
                    'name'=>'Marcos',
                    'lastname'=>'Llana Sánchez',
                    'address'=>'36308 Rolfsonini Hillatia Apt. 385',
                    'city'=>'Venecia',
                    'country'=>'Italia',
                    'zipcode'=>'23399',
                    'email'=>'bella@hotmail.es',
                    'phone'=>'334499332',
                    'birthdate'=>'1988-01-05',
                    'avatar'=>NULL,
                    'sex'=>'male',
                    'blood'=>'A-',
                    'role_id'=>1,
                    'remember_token'=>NULL,
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")  
                ],
                [
                    'id'=>11,
                    'dni'=>'24516113E',
                    'password'=>\Hash::make("123456"),
                    'name'=>'Manuel',
                    'lastname'=>'López Marín',
                    'address'=>'00499 Kling Lock Apt. 313',
                    'city'=>'Colombo',
                    'country'=>'Sri Lanka',
                    'zipcode'=>'23232',
                    'email'=>'yesno@gmail.com',
                    'phone'=>'099823403',
                    'birthdate'=>'1980-07-08',
                    'avatar'=>NULL,
                    'sex'=>'male',
                    'blood'=>'B+',
                    'role_id'=>2,
                    'remember_token'=>NULL,
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")  
                ],
                [
                    'id'=>12,
                    'dni'=>'70667220L',
                    'password'=>\Hash::make("123456"),
                    'name'=>'Sergio',
                    'lastname'=>'Manter Gil',
                    'address'=>'8829 Gust Valley Suite 564',
                    'city'=>'Minsk',
                    'country'=>'Bielorusia',
                    'zipcode'=>'30002',
                    'email'=>'guasa@gmail.com',
                    'phone'=>'632444014',
                    'birthdate'=>'1970-03-06',
                    'avatar'=>NULL,
                    'sex'=>'male',
                    'blood'=>'B+',
                    'role_id'=>3,
                    'remember_token'=>NULL,
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")  
                ],
                [
                    'id'=>13,
                    'dni'=>'99999999R',
                    'password'=>\Hash::make("123456"),
                    'name'=>'Miracle',
                    'lastname'=>'Villan',
                    'address'=>'Calle Alergia 1',
                    'city'=>'New York City',
                    'country'=>'United States',
                    'zipcode'=>'48490',
                    'email'=>'fapucippatteu-3015@yopmail.com',
                    'phone'=>'666999666',
                    'birthdate'=>'1994-05-02',
                    'avatar'=>NULL,
                    'sex'=>'male',
                    'blood'=>'A+',
                    'role_id'=>5,
                    'remember_token'=>NULL,
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")  
                ],
                [
                    'id'=>14,
                    'dni'=>'06009328A',
                    'password'=>\Hash::make("123456"),
                    'name'=>'Pilar',
                    'lastname'=>'Norto Garrido',
                    'address'=>'Calle propaganda 1',
                    'city'=>'Murcia',
                    'country'=>'España',
                    'zipcode'=>'20888',
                    'email'=>'nopuedeser@gmail.com',
                    'phone'=>'710990990',
                    'birthdate'=>'1980-08-16',
                    'avatar'=>NULL,
                    'sex'=>'female',
                    'blood'=>'B-',
                    'role_id'=>2,
                    'remember_token'=>NULL,
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")  
                ],
                [
                    'id'=>15,
                    'dni'=>'95111806K',
                    'password'=>\Hash::make("123456"),
                    'name'=>'Santiago',
                    'lastname'=>'Barbas Tones',
                    'address'=>'Calle juan muñoz',
                    'city'=>'Marbella',
                    'country'=>'España',
                    'zipcode'=>'29600',
                    'email'=>'zeittallauveinneu-5343@yopmail.com',
                    'phone'=>'916352001',
                    'birthdate'=>'1979-02-23',
                    'avatar'=>NULL,
                    'sex'=>'male',
                    'blood'=>'0+',
                    'role_id'=>2,
                    'remember_token'=>NULL,
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")  
                ],
                [
                    'id'=>16,
                    'dni'=>'89527310V',
                    'password'=>\Hash::make("123456"),
                    'name'=>'Tamara',
                    'lastname'=>'Bollo Galdés',
                    'address'=>'Calle pepa',
                    'city'=>'Valencia',
                    'country'=>'España',
                    'zipcode'=>'29899',
                    'email'=>'bolio@outlook.com',
                    'phone'=>'916551212',
                    'birthdate'=>'1972-04-14',
                    'avatar'=>NULL,
                    'sex'=>'female',
                    'blood'=>'AB+',
                    'role_id'=>2,
                    'remember_token'=>NULL,
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")  
                ],
                [
                    'id'=>17,
                    'dni'=>'22558706F',
                    'password'=>\Hash::make("123456"),
                    'name'=>'Gloria',
                    'lastname'=>'Carter Gómez',
                    'address'=>'Carrera Pa Cuándo, 169B 3ºB',
                    'city'=>'La Habana',
                    'country'=>'Cuba',
                    'zipcode'=>'11022',
                    'email'=>'toimoukounedo-3389@yopmail.com',
                    'phone'=>'633002450',
                    'birthdate'=>'1959-06-04',
                    'avatar'=>NULL,
                    'sex'=>'female',
                    'blood'=>'A+',
                    'role_id'=>1,
                    'remember_token'=>NULL,
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")  
                ],
                [
                    'id'=>18,
                    'dni'=>'77323787H',
                    'password'=>\Hash::make("123456"),
                    'name'=>'Carmen',
                    'lastname'=>'Secretaria Feliz',
                    'address'=>'88193 Dicki Isle',
                    'city'=>'Quito',
                    'country'=>'Ecuador ',
                    'zipcode'=>'88809',
                    'email'=>'soyfeliz@gmail.com',
                    'phone'=>'677009900',
                    'birthdate'=>'1979-07-03',
                    'avatar'=>NULL,
                    'sex'=>'female',
                    'blood'=>'A-',
                    'role_id'=>3,
                    'remember_token'=>NULL,
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")  
                ],
                [
                    'id'=>19,
                    'dni'=>'58743957W',
                    'password'=>\Hash::make("123456"),
                    'name'=>'Ruben',
                    'lastname'=>'Martínez Gorúa',
                    'address'=>'820 Moses Wells Apt. 955',
                    'city'=>'São Paulo',
                    'country'=>'Brazil',
                    'zipcode'=>'12123',
                    'email'=>'test@hotmail.es',
                    'phone'=>'094032043',
                    'birthdate'=>'1983-06-14',
                    'avatar'=>NULL,
                    'sex'=>'male',
                    'blood'=>'0+',
                    'role_id'=>1,
                    'remember_token'=>NULL,
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")  
                ],
                [
                    'id'=>20,
                    'dni'=>'12345678Z',
                    'password'=>\Hash::make("123456"),
                    'name'=>'Juan',
                    'lastname'=>'Pérez López',
                    'address'=>'54533 Stanton Branch Suite 659',
                    'city'=>'Damascus',
                    'country'=>'Syria',
                    'zipcode'=>'50900',
                    'email'=>'juanperez@gmail.com',
                    'phone'=>'395239803',
                    'birthdate'=>'1989-02-01',
                    'avatar'=>NULL,
                    'sex'=>'male',
                    'blood'=>'A-',
                    'role_id'=>1,
                    'remember_token'=>NULL,
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")  
                ],
                [
                    'id'=>21,
                    'dni'=>'61219973E',
                    'password'=>\Hash::make("123456"),
                    'name'=>'César',
                    'lastname'=>'Muñoz Cartagena',
                    'address'=>'90412 Kulas Terrace Apt. 149',
                    'city'=>'New Orleans',
                    'country'=>'United States',
                    'zipcode'=>'49320',
                    'email'=>'cesarhere@gmail.com',
                    'phone'=>'009278239',
                    'birthdate'=>'1970-03-08',
                    'avatar'=>NULL,
                    'sex'=>'male',
                    'blood'=>'0+',
                    'role_id'=>1,
                    'remember_token'=>NULL,
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")  
                ],
                [
                    'id'=>22,
                    'dni'=>'03106445L',
                    'password'=>\Hash::make("123456"),
                    'name'=>'Ana',
                    'lastname'=>'Mier de Cilla',
                    'address'=>'Calle Puerquecilla 2 10ºC',
                    'city'=>'Málaga',
                    'country'=>'España',
                    'zipcode'=>'29918',
                    'email'=>'anamierdecilla@gmail.com',
                    'phone'=>'666999666',
                    'birthdate'=>'1976-01-02',
                    'avatar'=>NULL,
                    'sex'=>'female',
                    'blood'=>'AB-',
                    'role_id'=>3,
                    'remember_token'=>NULL,
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")  
                ],
                [
                    'id'=>23,
                    'dni'=>'74577993X',
                    'password'=>\Hash::make("123456"),
                    'name'=>'Isolina',
                    'lastname'=>'Gato Sardina',
                    'address'=>'Calle Sin prisas nº8',
                    'city'=>'Bilbao',
                    'country'=>'España',
                    'zipcode'=>'27333',
                    'email'=>'isolina@gmail.com',
                    'phone'=>'666999666',
                    'birthdate'=>'1953-09-11',
                    'avatar'=>NULL,
                    'sex'=>'female',
                    'blood'=>'0+',
                    'role_id'=>2,
                    'remember_token'=>NULL,
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")  
                ],
                [
                    'id'=>24,
                    'dni'=>'92447570J',
                    'password'=>\Hash::make("123456"),
                    'name'=>'Ángela',
                    'lastname'=>'Márquez Claro',
                    'address'=>'Calle de Abradouiro',
                    'city'=>'Porto',
                    'country'=>'Portugal',
                    'zipcode'=>'20001',
                    'email'=>'noangels@gmail.com',
                    'phone'=>'987004832',
                    'birthdate'=>'1982-05-07',
                    'avatar'=>NULL,
                    'sex'=>'female',
                    'blood'=>'0-',
                    'role_id'=>3,
                    'remember_token'=>NULL,
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")  
                ],
                [
                    'id'=>25,
                    'dni'=>'32820724T',
                    'password'=>\Hash::make("123456"),
                    'name'=>'Francisco',
                    'lastname'=>'Jimeno Torres',
                    'address'=>'871 Guadalupe Place Apt. 559',
                    'city'=>'Riga',
                    'country'=>'Letonia',
                    'zipcode'=>'23990',
                    'email'=>'francis@outlook.es',
                    'phone'=>'920023042',
                    'birthdate'=>'1970-09-10',
                    'avatar'=>NULL,
                    'sex'=>'male',
                    'blood'=>'0+',
                    'role_id'=>2,
                    'remember_token'=>NULL,
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")  
                ],
                [
                    'id'=>26,
                    'dni'=>'42763206L',
                    'password'=>\Hash::make("123456"),
                    'name'=>'Daniel',
                    'lastname'=>'Pérez Martin',
                    'address'=>'Carrer dolor site, 10 17ºC',
                    'city'=>'Ababa',
                    'country'=>'Guatemala',
                    'zipcode'=>'23400',
                    'email'=>'aa@gmail.com',
                    'phone'=>'677889900',
                    'birthdate'=>'1979-05-08',
                    'avatar'=>NULL,
                    'sex'=>'male',
                    'blood'=>'0+',
                    'role_id'=>1,
                    'remember_token'=>NULL,
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")  
                ],
                [
                    'id'=>27,
                    'dni'=>'44465693T',
                    'password'=>\Hash::make("123456"),
                    'name'=>'Perfecto',
                    'lastname'=>'Ladrón Honrado',
                    'address'=>'Glorieta de Mexico, 2',
                    'city'=>'Guadalajara',
                    'country'=>'Mexico',
                    'zipcode'=>'98606',
                    'email'=>'perfectoladron@hotmail.com',
                    'phone'=>'666999666',
                    'birthdate'=>'1963-03-29',
                    'avatar'=>NULL,
                    'sex'=>'male',
                    'blood'=>'B+',
                    'role_id'=>1,
                    'remember_token'=>NULL,
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")  
                ],
                [
                    'id'=>28,
                    'dni'=>'70093070H',
                    'password'=>\Hash::make("123456"),
                    'name'=>'Teresa',
                    'lastname'=>'Marco Gol',
                    'address'=>'C. Comercial de las Avenidas, 25 10ºC',
                    'city'=>'Cuenca',
                    'country'=>'España',
                    'zipcode'=>'21938',
                    'email'=>'teresamarcogol@gmail.com',
                    'phone'=>'666999666',
                    'birthdate'=>'1989-09-06',
                    'avatar'=>NULL,
                    'sex'=>'female',
                    'blood'=>'A-',
                    'role_id'=>5,
                    'remember_token'=>NULL,
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")  
                ],
                [
                    'id'=>29,
                    'dni'=>'79177393P',
                    'password'=>\Hash::make("123456"),
                    'name'=>'Rupert',
                    'lastname'=>'Madden',
                    'address'=>'3 Carole Track',
                    'city'=>'Abu Dhabi',
                    'country'=>'United Arab Emirates',
                    'zipcode'=>'35084',
                    'email'=>'botririzacau-3679@yopmail.com',
                    'phone'=>'666999666',
                    'birthdate'=>'1999-01-20',
                    'avatar'=>NULL,
                    'sex'=>'female',
                    'blood'=>'A+',
                    'role_id'=>2,
                    'remember_token'=>NULL,
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")  
                ],
                [
                    'id'=>30,
                    'dni'=>'70059488Q',
                    'password'=>\Hash::make("123456"),
                    'name'=>'William',
                    'lastname'=>'Danksworth',
                    'address'=>'329 Haylie Street',
                    'city'=>'Bristol',
                    'country'=>'England',
                    'zipcode'=>'24448',
                    'email'=>'no@gmail.com',
                    'phone'=>'666999666',
                    'birthdate'=>'1959-08-20',
                    'avatar'=>NULL,
                    'sex'=>'male',
                    'blood'=>'AB+',
                    'role_id'=>2,
                    'remember_token'=>NULL,
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")  
                ],
                [
                    'id'=>31,
                    'dni'=>'08708141L',
                    'password'=>\Hash::make("123456"),
                    'name'=>'Susan',
                    'lastname'=>'Brown',
                    'address'=>'Conecicut st. 25',
                    'city'=>'Adelaide',
                    'country'=>'Australia',
                    'zipcode'=>'18938',
                    'email'=>'wiginnosenna-6062@yopmail.com',
                    'phone'=>'666999666',
                    'birthdate'=>'1999-01-20',
                    'avatar'=>NULL,
                    'sex'=>'female',
                    'blood'=>'B+',
                    'role_id'=>1,
                    'remember_token'=>NULL,
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")  
                ],
            ]
        );

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

    }
}
