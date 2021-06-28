<?php

namespace Database\Seeders;
use DB;
use Illuminate\Database\Seeder;
class SpecialitiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        DB::table('specialities')->insert(
            [
                [
                    'name'=>'Alergologia',
                    'speciality_type'=>'doctor',
                    'role_id'=>2,
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'name'=>'Anestesiologia',
                    'speciality_type'=>'doctor',
                    'role_id'=>2,
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'name'=>'Angiologia',
                    'speciality_type'=>'doctor',
                    'role_id'=>2,
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s") 
                ],
                [
                    'name'=>'Bariatria',
                    'speciality_type'=>'doctor',
                    'role_id'=>2,
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'name'=>'Cardiologia',
                    'speciality_type'=>'doctor',
                    'role_id'=>2,
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'name'=>'Cirugia General',
                    'speciality_type'=>'doctor',
                    'role_id'=>2,
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'name'=>'Cirugia Maxilofacial',
                    'speciality_type'=>'doctor',
                    'role_id'=>2,
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s") 
                ],
                [
                    'name'=>'Cirugia Plastica',
                    'speciality_type'=>'doctor',
                    'role_id'=>2,
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'name'=>'Cirugia Estetica',
                    'speciality_type'=>'doctor',
                    'role_id'=>2,
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'name'=>'Dermatologia',
                    'speciality_type'=>'doctor',
                    'role_id'=>2,
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s") 
                ],
                [
                    'name'=>'Enocrinologia',
                    'speciality_type'=>'doctor',
                    'role_id'=>2,
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'name'=>'Endoscopia',
                    'speciality_type'=>'doctor',
                    'role_id'=>2,
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'name'=>'Fisiatria',
                    'speciality_type'=>'doctor',
                    'role_id'=>2,
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'name'=>'Gastroenterologia',
                    'speciality_type'=>'doctor',
                    'role_id'=>2,
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s") 
                ],
                [
                    'name'=>'Geriatria',
                    'speciality_type'=>'doctor',
                    'role_id'=>2,
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'name'=>'Ginecologia',
                    'speciality_type'=>'doctor',
                    'role_id'=>2,
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'name'=>'Hematologia',
                    'speciality_type'=>'doctor',
                    'role_id'=>2,
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'name'=>'Infectologia',
                    'speciality_type'=>'doctor',
                    'role_id'=>2,
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s") 
                ],
                [
                    'name'=>'Inmunologia',
                    'speciality_type'=>'doctor',
                    'role_id'=>2,
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s") 
                ],                
                [
                    'name'=>'Medicina general',
                    'speciality_type'=>'doctor',
                    'role_id'=>2,
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s") 
                ],                
                [
                    'name'=>'Microcirugia',
                    'speciality_type'=>'doctor',
                    'role_id'=>2,
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s") 
                ],                
                [
                    'name'=>'Nefrologia',
                    'speciality_type'=>'doctor',
                    'role_id'=>2,
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s") 
                ],                
                [
                    'name'=>'Neonatologia',
                    'speciality_type'=>'doctor',
                    'role_id'=>2,
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s") 
                ],                
                [
                    'name'=>'Neumologia',
                    'speciality_type'=>'doctor',
                    'role_id'=>2,
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s") 
                ],                
                [
                    'name'=>'Neurologia',
                    'speciality_type'=>'doctor',
                    'role_id'=>2,
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s") 
                ],                
                [
                    'name'=>'Neurocirugia',
                    'speciality_type'=>'doctor',
                    'role_id'=>2,
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s") 
                ],                
                [
                    'name'=>'Nutricion',
                    'speciality_type'=>'doctor',
                    'role_id'=>2,
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s") 
                ],                
                [
                    'name'=>'Oftalmologia',
                    'speciality_type'=>'doctor',
                    'role_id'=>2,
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s") 
                ],                
                [
                    'name'=>'Oncologia',
                    'speciality_type'=>'doctor',
                    'role_id'=>2,
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s") 
                ],                
                [
                    'name'=>'Ortopedia',
                    'speciality_type'=>'doctor',
                    'role_id'=>2,
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s") 
                ],                
                [
                    'name'=>'Otorrinolaringologia',
                    'speciality_type'=>'doctor',
                    'role_id'=>2,
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s") 
                ],                
                [
                    'name'=>'Pediatria',
                    'speciality_type'=>'doctor',
                    'role_id'=>2,
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s") 
                ],                
                [
                    'name'=>'Patologia',
                    'speciality_type'=>'doctor',
                    'role_id'=>2,
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s") 
                ],                
                [
                    'name'=>'Perinatologia',
                    'speciality_type'=>'doctor',
                    'role_id'=>2,
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s") 
                ],                
                [
                    'name'=>'Proctologia',
                    'speciality_type'=>'doctor',
                    'role_id'=>2,  
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s") 
                ],                
                [
                    'name'=>'Psiquiatria',
                    'speciality_type'=>'doctor',
                    'role_id'=>2,
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s") 
                ],                
                [
                    'name'=>'Radiologia',
                    'speciality_type'=>'doctor',
                    'role_id'=>2,
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s") 
                ],                              
                [
                    'name'=>'Reumatologia',
                    'speciality_type'=>'doctor',
                    'role_id'=>2,
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s") 
                ],                             
                [
                    'name'=>'Traumatologia',
                    'speciality_type'=>'doctor',
                    'role_id'=>2,
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s") 
                ],                
                [
                    'name'=>'Urologia',
                    'speciality_type'=>'doctor',
                    'role_id'=>2,
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s") 
                ],     
                [
                    'name'=>'Administrativo',
                    'speciality_type'=>'helper',
                    'role_id'=>3,
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ], 
                [
                    'name'=>'Citaciones (Administrativo)',
                    'speciality_type'=>'helper',
                    'role_id'=>3,
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'name'=>'Recepcionista (Administrativo)',
                    'speciality_type'=>'helper',
                    'role_id'=>3,
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s") 
                ],  
                [
                    'name'=>'Secretario/a (Administrativo)',
                    'speciality_type'=>'helper',
                    'role_id'=>3,
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s") 
                ],               
                [
                    'name'=>'Otros (P.Sanitario)',
                    'speciality_type'=>'helper',
                    'role_id'=>3,
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s") 
                ],                
                [
                    'name'=>'Otros (P.Administrativo)',
                    'speciality_type'=>'helper',
                    'role_id'=>3,
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s") 
                ],              
            ]
        );

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

    }
}
