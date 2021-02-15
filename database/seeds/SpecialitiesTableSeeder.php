<?php

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
                    'branch_type'=>'doctor',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'name'=>'Anestesiologia',
                    'branch_type'=>'doctor',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'name'=>'Angiologia',
                    'branch_type'=>'doctor',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s") 
                ],
                [
                    'name'=>'Bariatria',
                    'branch_type'=>'doctor',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'name'=>'Cardiologia',
                    'branch_type'=>'doctor',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'name'=>'Cirugia General',
                    'branch_type'=>'doctor',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'name'=>'Cirugia Maxilofacial',
                    'branch_type'=>'doctor',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s") 
                ],
                [
                    'name'=>'Cirugia Plastica',
                    'branch_type'=>'doctor',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'name'=>'Cirugia Estetica',
                    'branch_type'=>'doctor',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'name'=>'Dermatologia',
                    'branch_type'=>'doctor',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s") 
                ],
                [
                    'name'=>'Enocrinologia',
                    'branch_type'=>'doctor',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'name'=>'Endoscopia',
                    'branch_type'=>'doctor',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'name'=>'Fisiatria',
                    'branch_type'=>'doctor',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'name'=>'Gastroenterologia',
                    'branch_type'=>'doctor',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s") 
                ],
                [
                    'name'=>'Geriatria',
                    'branch_type'=>'doctor',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'name'=>'Ginecologia',
                    'branch_type'=>'doctor',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'name'=>'Hematologia',
                    'branch_type'=>'doctor',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'name'=>'Infectologia',
                    'branch_type'=>'doctor',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s") 
                ],
                [
                    'name'=>'Inmunologia',
                    'branch_type'=>'doctor',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s") 
                ],                
                [
                    'name'=>'Medicina general',
                    'branch_type'=>'doctor',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s") 
                ],                
                [
                    'name'=>'Microcirugia',
                    'branch_type'=>'doctor',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s") 
                ],                
                [
                    'name'=>'Nefrologia',
                    'branch_type'=>'doctor',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s") 
                ],                
                [
                    'name'=>'Neonatologia',
                    'branch_type'=>'doctor',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s") 
                ],                
                [
                    'name'=>'Neumologia',
                    'branch_type'=>'doctor',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s") 
                ],                
                [
                    'name'=>'Neurologia',
                    'branch_type'=>'doctor',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s") 
                ],                
                [
                    'name'=>'Neurocirugia',
                    'branch_type'=>'doctor',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s") 
                ],                
                [
                    'name'=>'Nutricion',
                    'branch_type'=>'doctor',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s") 
                ],                
                [
                    'name'=>'Oftalmologia',
                    'branch_type'=>'doctor',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s") 
                ],                
                [
                    'name'=>'Oncologia',
                    'branch_type'=>'doctor',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s") 
                ],                
                [
                    'name'=>'Ortopedia',
                    'branch_type'=>'doctor',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s") 
                ],                
                [
                    'name'=>'Otorrinolaringologia',
                    'branch_type'=>'doctor',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s") 
                ],                
                [
                    'name'=>'Pediatria',
                    'branch_type'=>'doctor',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s") 
                ],                
                [
                    'name'=>'Patologia',
                    'branch_type'=>'doctor',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s") 
                ],                
                [
                    'name'=>'Perinatologia',
                    'branch_type'=>'doctor',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s") 
                ],                
                [
                    'name'=>'Proctologia',
                    'branch_type'=>'doctor',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s") 
                ],                
                [
                    'name'=>'Psiquiatria',
                    'branch_type'=>'doctor',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s") 
                ],                
                [
                    'name'=>'Radiologia',
                    'branch_type'=>'doctor',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s") 
                ],                              
                [
                    'name'=>'Reumatologia',
                    'branch_type'=>'doctor',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s") 
                ],                             
                [
                    'name'=>'Traumatologia',
                    'branch_type'=>'doctor',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s") 
                ],                
                [
                    'name'=>'Urologia',
                    'branch_type'=>'doctor',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s") 
                ],     
                [
                    'name'=>'Administrativo',
                    'branch_type'=>'helper',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ], 
                [
                    'name'=>'Citaciones (Administrativo)',
                    'branch_type'=>'helper',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'name'=>'Recepcionista (Administrativo)',
                    'branch_type'=>'helper',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s") 
                ],  
                [
                    'name'=>'Secretario/a (Administrativo)',
                    'branch_type'=>'helper',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s") 
                ],               
                [
                    'name'=>'Otros (P.Sanitario)',
                    'branch_type'=>'helper',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s") 
                ],                
                [
                    'name'=>'Otros (P.Administrativo)',
                    'branch_type'=>'helper',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s") 
                ],              
            ]
        );

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

    }
}
