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
                    'password'=>\Hash::make("918038717p.P"),
                    // 'password'=>'$2y$10$AJ446eQleao9Ti4uzzd.EeCsAA1OZVYQnlb543uAXO6vpjBYrDB7W',
                    'name'=>'Pedro Ramón',
                    'lastname'=>'Moreno Martín',
                    'address'=>'Gloriera Sin nombre 5',
                    'city'=>'Valdemoro',
                    'country_id'=>'203',
                    'zipcode'=>'28342',
                    'email'=>'pedroramonmm@gmail.com',
                    'phone_prefix_id'=>'261',
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
                    'password'=>\Hash::make("918038717p.P"),
                    'name'=>'Juan',
                    'lastname'=>'Chacón Pérez',
                    'address'=>'Plaza de San Eustequio 3',
                    'city'=>'Mostoles',
                    'country_id'=>'203',
                    'zipcode'=>'28938',
                    'email'=>'pedroramonmmspam1@gmail.com',
                    'phone_prefix_id'=>'261',
                    'phone'=>'677912305',
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
                    'password'=>\Hash::make("918038717p.P"),
                    'name'=>'David',
                    'lastname'=>'Pérez López',
                    'address'=>'822 Fay Summit Apt. 023',
                    'city'=>'Seoul',
                    'country_id'=>'201',
                    'zipcode'=>'33440',
                    'email'=>'overhere@gmail.com',
                    'phone_prefix_id'=>'261',
                    'phone'=>'686668826',
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
                    'password'=>\Hash::make("918038717p.P"),
                    'name'=>'María',
                    'lastname'=>'Márquez Muñoz',
                    'address'=>'1686 Kathryne Skyway Apt. 519',
                    'city'=>'Amsterdam',
                    'country_id'=>'151',
                    'zipcode'=>'99023',
                    'email'=>'maria@gmail.com',
                    'phone_prefix_id'=>'261',
                    'phone'=>'650220074',
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
                    'password'=>\Hash::make("918038717p.P"),
                    'name'=>'Laura',
                    'lastname'=>'Sánchez Sanz',
                    'address'=>'75251 Russel Islands Apt. 627',
                    'city'=>'Belgrado',
                    'country_id'=>'191',
                    'zipcode'=>'13323',
                    'email'=>'pedroramonmmspam2@gmail.com',
                    'phone_prefix_id'=>'261',
                    'phone'=>'677770136',
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
                    'password'=>\Hash::make("918038717p.P"),
                    'name'=>'Pedro',
                    'lastname'=>'Rodríguez Cano',
                    'address'=>'Calle murcia 55',
                    'city'=>'Mostoles',
                    'country_id'=>'203',
                    'zipcode'=>'24938',
                    'email'=>'pedro_rmm@hotmail.es',
                    'phone_prefix_id'=>'261',
                    'phone'=>'666222347',
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
                    'password'=>\Hash::make("918038717p.P"),
                    'name'=>'Susana',
                    'lastname'=>'Braga Palomino',
                    'address'=>'Calle Jones Spur 2',
                    'city'=>'Mostoles',
                    'country_id'=>'203',
                    'zipcode'=>'21234',
                    'email'=>'braurittunauda-4128@yopmail.com',
                    'phone_prefix_id'=>'261',
                    'phone'=>'677778899',
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
                    'password'=>\Hash::make("918038717p.P"),
                    'name'=>'Augusto',
                    'lastname'=>'Bragueta Suelta',
                    'address'=>'Avenida de las Iglesias 14',
                    'city'=>'Cúcuta',
                    'country_id'=>'47',
                    'zipcode'=>'25938',
                    'email'=>'dacreugreimeme-9179@yopmail.com',
                    'phone_prefix_id'=>'261',
                    'phone'=>'666556566',
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
                    'password'=>\Hash::make("918038717p.P"),
                    'name'=>'Agustín',
                    'lastname'=>'Cabeza Compostizo',
                    'address'=>'Calle Cabeza 4',
                    'city'=>'Cádiz',
                    'country_id'=>'203',
                    'zipcode'=>'28768',
                    'email'=>'gradessuproqua-6162@yopmail.com',
                    'phone_prefix_id'=>'261',
                    'phone'=>'654340098',   
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
                    'password'=>\Hash::make("918038717p.P"),
                    'name'=>'Marcos',
                    'lastname'=>'Llana Sánchez',
                    'address'=>'36308 Rolfsonini Hillatia Apt. 385',
                    'city'=>'Venecia',
                    'country_id'=>'105',
                    'zipcode'=>'23399',
                    'email'=>'bella@hotmail.es',
                    'phone_prefix_id'=>'261',
                    'phone'=>'646778323',
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
                    'password'=>\Hash::make("918038717p.P"),
                    'name'=>'Manuel',
                    'lastname'=>'López Marín',
                    'address'=>'00499 Kling Lock Apt. 313',
                    'city'=>'Colombo',
                    'country_id'=>'204',
                    'zipcode'=>'23232',
                    'email'=>'yesno@gmail.com',
                    'phone_prefix_id'=>'261',
                    'phone'=>'099823903',
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
                    'password'=>\Hash::make("918038717p.P"),
                    'name'=>'Sergio',
                    'lastname'=>'Manter Gil',
                    'address'=>'8829 Gust Valley Suite 564',
                    'city'=>'Minsk',
                    'country_id'=>'19',
                    'zipcode'=>'30002',
                    'email'=>'guasa@gmail.com',
                    'phone_prefix_id'=>'261',
                    'phone'=>'632444015',
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
                    'password'=>\Hash::make("918038717p.P"),
                    'name'=>'Miracle',
                    'lastname'=>'Villan',
                    'address'=>'Calle Alergia 1',
                    'city'=>'New York City',
                    'country_id'=>'231',
                    'zipcode'=>'48490',
                    'email'=>'fapucippatteu-3015@yopmail.com',
                    'phone_prefix_id'=>'261',
                    'phone'=>'666999866',
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
                    'password'=>\Hash::make("918038717p.P"),
                    'name'=>'Pilar',
                    'lastname'=>'Norto Garrido',
                    'address'=>'Calle propaganda 1',
                    'city'=>'Murcia',
                    'country_id'=>'203',
                    'zipcode'=>'20888',
                    'email'=>'nopuedeser@gmail.com',
                    'phone_prefix_id'=>'261',
                    'phone'=>'610990990',
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
                    'password'=>\Hash::make("918038717p.P"),
                    'name'=>'Santiago',
                    'lastname'=>'Barbas Tones',
                    'address'=>'Calle juan muñoz',
                    'city'=>'Marbella',
                    'country_id'=>'203',
                    'zipcode'=>'29600',
                    'email'=>'zeittallauveinneu-5343@yopmail.com',
                    'phone_prefix_id'=>'261',
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
                    'password'=>\Hash::make("918038717p.P"),
                    'name'=>'Tamara',
                    'lastname'=>'Bollo Galdés',
                    'address'=>'Calle pepa',
                    'city'=>'Valencia',
                    'country_id'=>'203',
                    'zipcode'=>'29899',
                    'email'=>'bolio@outlook.com',
                    'phone_prefix_id'=>'261',
                    'phone'=>'916551213',
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
                    'password'=>\Hash::make("918038717p.P"),
                    'name'=>'Gloria',
                    'lastname'=>'Carter Gómez',
                    'address'=>'Carrera Pa Cuándo, 169B 3ºB',
                    'city'=>'La Habana',
                    'country_id'=>'55',
                    'zipcode'=>'11022',
                    'email'=>'toimoukounedo-3389@yopmail.com',
                    'phone_prefix_id'=>'261',
                    'phone'=>'633002456',
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
                    'password'=>\Hash::make("918038717p.P"),
                    'name'=>'Carmen',
                    'lastname'=>'Secretaria Feliz',
                    'address'=>'88193 Dicki Isle',
                    'city'=>'Quito',
                    'country_id'=>'63',
                    'zipcode'=>'88809',
                    'email'=>'soyfeliz@gmail.com',
                    'phone_prefix_id'=>'261',
                    'phone'=>'677009940',
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
                    'password'=>\Hash::make("918038717p.P"),
                    'name'=>'Ruben',
                    'lastname'=>'Martínez Gorúa',
                    'address'=>'820 Moses Wells Apt. 955',
                    'city'=>'São Paulo',
                    'country_id'=>'28',
                    'zipcode'=>'12123',
                    'email'=>'test@hotmail.es',
                    'phone_prefix_id'=>'261',
                    'phone'=>'65445521',
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
                    'password'=>\Hash::make("918038717p.P"),
                    'name'=>'Juan',
                    'lastname'=>'Pérez López',
                    'address'=>'54533 Stanton Branch Suite 659',
                    'city'=>'Damascus',
                    'country_id'=>'211',
                    'zipcode'=>'50900',
                    'email'=>'juanperez@gmail.com',
                    'phone_prefix_id'=>'261',
                    'phone'=>'699090922',
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
                    'password'=>\Hash::make("918038717p.P"),
                    'name'=>'César',
                    'lastname'=>'Muñoz Cartagena',
                    'address'=>'90412 Kulas Terrace Apt. 149',
                    'city'=>'New Orleans',
                    'country_id'=>'231',
                    'zipcode'=>'49320',
                    'email'=>'cesarhere@gmail.com',
                    'phone_prefix_id'=>'261',
                    'phone'=>'677875672',
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
                    'password'=>\Hash::make("918038717p.P"),
                    'name'=>'Ana',
                    'lastname'=>'Mier de Cilla',
                    'address'=>'Calle Puerquecilla 2 10ºC',
                    'city'=>'Málaga',
                    'country_id'=>'203',
                    'zipcode'=>'29918',
                    'email'=>'anamierdecilla@gmail.com',
                    'phone_prefix_id'=>'261',
                    'phone'=>'611999666',
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
                    'password'=>\Hash::make("918038717p.P"),
                    'name'=>'Isolina',
                    'lastname'=>'Gato Sardina',
                    'address'=>'Calle Sin prisas nº8',
                    'city'=>'Bilbao',
                    'country_id'=>'203',
                    'zipcode'=>'27333',
                    'email'=>'isolina@gmail.com',
                    'phone_prefix_id'=>'261',
                    'phone'=>'600999666',
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
                    'password'=>\Hash::make("918038717p.P"),
                    'name'=>'Ángela',
                    'lastname'=>'Márquez Claro',
                    'address'=>'Calle de Abradouiro',
                    'city'=>'Porto',
                    'country_id'=>'172',
                    'zipcode'=>'20001',
                    'email'=>'noangels@gmail.com',
                    'phone_prefix_id'=>'261',
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
                    'password'=>\Hash::make("918038717p.P"),
                    'name'=>'Francisco',
                    'lastname'=>'Jimeno Torres',
                    'address'=>'871 Guadalupe Place Apt. 559',
                    'city'=>'Riga',
                    'country_id'=>'117',
                    'zipcode'=>'23990',
                    'email'=>'francis@outlook.es',
                    'phone_prefix_id'=>'261',
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
                    'password'=>\Hash::make("918038717p.P"),
                    'name'=>'Daniel',
                    'lastname'=>'Pérez Martin',
                    'address'=>'Carrer dolor site, 10 17ºC',
                    'city'=>'Ababa',
                    'country_id'=>'88',
                    'zipcode'=>'23400',
                    'email'=>'aa@gmail.com',
                    'phone_prefix_id'=>'261',
                    'phone'=>'677889901',
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
                    'password'=>\Hash::make("918038717p.P"),
                    'name'=>'Perfecto',
                    'lastname'=>'Ladrón Honrado',
                    'address'=>'Glorieta de Mexico, 2',
                    'city'=>'Guadalajara',
                    'country_id'=>'138',
                    'zipcode'=>'98606',
                    'email'=>'perfectoladron@hotmail.com',
                    'phone_prefix_id'=>'261',
                    'phone'=>'611999662',
                    'birthdate'=>'1963-03-29',
                    'avatar'=>NULL,
                    'sex'=>'male',
                    'blood'=>'B-',
                    'role_id'=>1,
                    'remember_token'=>NULL,
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")  
                ],
                [
                    'id'=>28,
                    'dni'=>'70093070H',
                    'password'=>\Hash::make("918038717p.P"),
                    'name'=>'Teresa',
                    'lastname'=>'Marco Gol',
                    'address'=>'C. Comercial de las Avenidas, 25 10ºC',
                    'city'=>'Cuenca',
                    'country_id'=>'203',
                    'zipcode'=>'21938',
                    'email'=>'teresamarcogol@gmail.com',
                    'phone_prefix_id'=>'261',
                    'phone'=>'677900663',
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
                    'password'=>\Hash::make("918038717p.P"),
                    'name'=>'Rupert',
                    'lastname'=>'Madden',
                    'address'=>'3 Carole Track',
                    'city'=>'Abu Dhabi',
                    'country_id'=>'229',
                    'zipcode'=>'35084',
                    'email'=>'botririzacau-3679@yopmail.com',
                    'phone_prefix_id'=>'261',
                    'phone'=>'602959666',
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
                    'password'=>\Hash::make("918038717p.P"),
                    'name'=>'William',
                    'lastname'=>'Danksworth',
                    'address'=>'329 Haylie Street',
                    'city'=>'Bristol',
                    'country_id'=>'230',
                    'zipcode'=>'24448',
                    'email'=>'no@gmail.com',
                    'phone_prefix_id'=>'261',
                    'phone'=>'636999506',
                    'birthdate'=>'1969-07-25',
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
                    'dni'=>'95390373N',
                    'password'=>\Hash::make("918038717p.P"),
                    'name'=>'Susan',
                    'lastname'=>'Brown',
                    'address'=>'Conecicut st. 25',
                    'city'=>'Adelaide',
                    'country_id'=>'12',
                    'zipcode'=>'18938',
                    'email'=>'monty.atkins@shark.com',
                    'phone_prefix_id'=>'261',
                    'phone'=>'613999697',
                    'birthdate'=>'1981-10-24',
                    'avatar'=>NULL,
                    'sex'=>'female',
                    'blood'=>'B+',
                    'role_id'=>1,
                    'remember_token'=>NULL,
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")  
                ],

                [
                    'id'=>32,
                    'dni'=>'16796839P',
                    'password'=>\Hash::make("918038717p.P"),
                    'name'=>'Dolores',
                    'lastname'=>'Fuertes de Barriga',
                    'address'=>'Calle Aleix, 9, 84º C',
                    'city'=>'Alicante',
                    'country_id'=>'12',
                    'zipcode'=>'37698',
                    'email'=>'rennoiliboitre-6314@yopmail.com',
                    'phone_prefix_id'=>'261',
                    'phone'=>'694015563',
                    'birthdate'=>'1959-05-18',
                    'avatar'=>NULL,
                    'sex'=>'female',
                    'blood'=>'AB-',
                    'role_id'=>1,
                    'remember_token'=>NULL,
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")  
                ],
                [
                    'id'=>33,
                    'dni'=>'73325818R',
                    'password'=>\Hash::make("918038717p.P"),
                    'name'=>'Abundio',
                    'lastname'=>'Verdugo de Dios',
                    'address'=>'Praza Santillán, 0, 9º D',
                    'city'=>'La Correa',
                    'country_id'=>'12',
                    'zipcode'=>'82071',
                    'email'=>'pruzuteyauco-5408@yopmail.com',
                    'phone_prefix_id'=>'261',
                    'phone'=>'677012387',
                    'birthdate'=>'1954-11-24',
                    'avatar'=>NULL,
                    'sex'=>'male',
                    'blood'=>'A-',
                    'role_id'=>1,
                    'remember_token'=>NULL,
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")  
                ],
                [
                    'id'=>34,
                    'dni'=>'14862512G',
                    'password'=>\Hash::make("918038717p.P"),
                    'name'=>'Paco',
                    'lastname'=>'Trabajo Cumplido',
                    'address'=>'Calle Teresa, 6, 23º D',
                    'city'=>'A Echevarría Baja',
                    'country_id'=>'12',
                    'zipcode'=>'84633',
                    'email'=>'zuveyagruro-9598@yopmail.com',
                    'phone_prefix_id'=>'261',
                    'phone'=>'695302573',
                    'birthdate'=>'1974-05-16',
                    'avatar'=>NULL,
                    'sex'=>'male',
                    'blood'=>'A+',
                    'role_id'=>1,
                    'remember_token'=>NULL,
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")  
                ],
                [
                    'id'=>35,
                    'dni'=>'71829180L',
                    'password'=>\Hash::make("918038717p.P"),
                    'name'=>'Alfonso',
                    'lastname'=>'Seisdedos Pies Planos',
                    'address'=>'Passeig Casanova, 941, 5º 4º',
                    'city'=>'Tarragona',
                    'country_id'=>'12',
                    'zipcode'=>'68869',
                    'email'=>'tradeddeuquedde-4377@yopmail.com',
                    'phone_prefix_id'=>'261',
                    'phone'=>'694620087',
                    'birthdate'=>'1988-10-23',
                    'avatar'=>NULL,
                    'sex'=>'male',
                    'blood'=>'0+',
                    'role_id'=>1,
                    'remember_token'=>NULL,
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")  
                ],
                [
                    'id'=>36,
                    'dni'=>'97294438E',
                    'password'=>\Hash::make("918038717p.P"),
                    'name'=>'Ana',
                    'lastname'=>'Púlpito Salido',
                    'address'=>'Avinguda Mar, 991, 5º A',
                    'city'=>'Vall Godínez de Ulla',
                    'country_id'=>'12',
                    'zipcode'=>'53126',
                    'email'=>'judafeugugreu-4604@yopmail.com',
                    'phone_prefix_id'=>'261',
                    'phone'=>'674032864',
                    'birthdate'=>'1975-10-15',
                    'avatar'=>NULL,
                    'sex'=>'female',
                    'blood'=>'AB-',
                    'role_id'=>1,
                    'remember_token'=>NULL,
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")  
                ],
                [
                    'id'=>37,
                    'dni'=>'82597298C',
                    'password'=>\Hash::make("918038717p.P"),
                    'name'=>'Estefanía',
                    'lastname'=>'Ponte Alegre',
                    'address'=>'Carrer Ainhoa, 1, 70º C',
                    'city'=>'Barcelona',
                    'country_id'=>'12',
                    'zipcode'=>'35730',
                    'email'=>'fruvosacreitta-8329@yopmail.com',
                    'phone_prefix_id'=>'261',
                    'phone'=>'692969624',
                    'birthdate'=>'1976-07-17',
                    'avatar'=>NULL,
                    'sex'=>'female',
                    'blood'=>'0-',
                    'role_id'=>1,
                    'remember_token'=>NULL,
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")  
                ],
                [
                    'id'=>38,
                    'dni'=>'99667510T',
                    'password'=>\Hash::make("918038717p.P"),
                    'name'=>'Rosa',
                    'lastname'=>'Pechoabierto y del Cacho',
                    'address'=>'Avenida Velázquez, 489, Bajos',
                    'city'=>'Cartagena',
                    'country_id'=>'12',
                    'zipcode'=>'86706',
                    'email'=>'yeuwiyausseru-2188@yopmail.com',
                    'phone_prefix_id'=>'261',
                    'phone'=>'635999699',
                    'birthdate'=>'1971-09-28',
                    'avatar'=>NULL,
                    'sex'=>'female',
                    'blood'=>'0+',
                    'role_id'=>1,
                    'remember_token'=>NULL,
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")  
                ],
                [
                    'id'=>39,
                    'dni'=>'79623074H',
                    'password'=>\Hash::make("918038717p.P"),
                    'name'=>'Luis',
                    'lastname'=>'Gordo de Día',
                    'address'=>'Ronda Raúl, 5, 15º 0º',
                    'city'=>'Las Riera del Bages',
                    'country_id'=>'12',
                    'zipcode'=>'86215',
                    'email'=>'kogrecrellagoi-7248@yopmail.com',
                    'phone_prefix_id'=>'261',
                    'phone'=>'609999692',
                    'birthdate'=>'1948-03-11',
                    'avatar'=>NULL,
                    'sex'=>'male',
                    'blood'=>'AB+',
                    'role_id'=>1,
                    'remember_token'=>NULL,
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")  
                ],
                [
                    'id'=>40,
                    'dni'=>'80652796F',
                    'password'=>\Hash::make("918038717p.P"),
                    'name'=>'Esther',
                    'lastname'=>'Tirado Rico',
                    'address'=>'Travessera Gabriela, 603, Entre suelo 7º',
                    'city'=>'Gandía',
                    'country_id'=>'12',
                    'zipcode'=>'98585',
                    'email'=>'hihubruquegri-3025@yopmail.com',
                    'phone_prefix_id'=>'261',
                    'phone'=>'692999691',
                    'birthdate'=>'1949-11-24',
                    'avatar'=>NULL,
                    'sex'=>'female',
                    'blood'=>'B+',
                    'role_id'=>1,
                    'remember_token'=>NULL,
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")  
                ],
                [
                    'id'=>41,
                    'dni'=>'62757138M',
                    'password'=>\Hash::make("918038717p.P"),
                    'name'=>'Julio',
                    'lastname'=>'Domingo Abril',
                    'address'=>'Paseo Héctor, 433, 6º E',
                    'city'=>'Nerja',
                    'country_id'=>'12',
                    'zipcode'=>'65886',
                    'email'=>'woitroijeweibe-6772@yopmail.com',
                    'phone_prefix_id'=>'261',
                    'phone'=>'638999682',
                    'birthdate'=>'1957-11-19',
                    'avatar'=>NULL,
                    'sex'=>'male',
                    'blood'=>'B-',
                    'role_id'=>1,
                    'remember_token'=>NULL,
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")  
                ],
                [
                    'id'=>42,
                    'dni'=>'83253893B',
                    'password'=>\Hash::make("918038717p.P"),
                    'name'=>'Tomás',
                    'lastname'=>'Aguas de la Fuente',
                    'address'=>'Ronda Alexia, 987, 2º 5º',
                    'city'=>'Badajoz',
                    'country_id'=>'12',
                    'zipcode'=>'18409',
                    'email'=>'xuffigetouqua-2063@yopmail.com',
                    'phone_prefix_id'=>'261',
                    'phone'=>'613999690',
                    'birthdate'=>'1987-03-11',
                    'avatar'=>NULL,
                    'sex'=>'female',
                    'blood'=>'A+',
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
