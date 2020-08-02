<?php

use Illuminate\Database\Seeder;

class BranchesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('branches')->insert(
            [
                [
                    'name'=>'Alergologia',
                    'role_id'=>'2',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'name'=>'Anestesiologia',
                    'role_id'=>'2',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'name'=>'Angiologia',
                    'role_id'=>'2',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s") 
                ],
                [
                    'name'=>'Bariatria',
                    'role_id'=>'2',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'name'=>'Cardiologia',
                    'role_id'=>'2',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'name'=>'Cirugia General',
                    'role_id'=>'2',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'name'=>'Cirugia Maxilofacial',
                    'role_id'=>'2',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s") 
                ],
                [
                    'name'=>'Cirugia Plastica',
                    'role_id'=>'2',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'name'=>'Cirugia Estetica',
                    'role_id'=>'2',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'name'=>'Dermatologia',
                    'role_id'=>'2',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s") 
                ],
                [
                    'name'=>'Enocrinologia',
                    'role_id'=>'2',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'name'=>'Endoscopia',
                    'role_id'=>'2',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'name'=>'Fisiatria',
                    'role_id'=>'2',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'name'=>'Gastroenterologia',
                    'role_id'=>'2',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s") 
                ],
                [
                    'name'=>'Geriatria',
                    'role_id'=>'2',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'name'=>'Ginecologia',
                    'role_id'=>'2',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'name'=>'Hematologia',
                    'role_id'=>'2',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'name'=>'Infectologia',
                    'role_id'=>'2',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s") 
                ],
                [
                    'name'=>'Inmunologia',
                    'role_id'=>'2',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s") 
                ],                
                [
                    'name'=>'Medicina general',
                    'role_id'=>'2',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s") 
                ],                
                [
                    'name'=>'Microcirugia',
                    'role_id'=>'2',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s") 
                ],                
                [
                    'name'=>'Nefrologia',
                    'role_id'=>'2',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s") 
                ],                
                [
                    'name'=>'Neonatologia',
                    'role_id'=>'2',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s") 
                ],                
                [
                    'name'=>'Neumologia',
                    'role_id'=>'2',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s") 
                ],                
                [
                    'name'=>'Neurologia',
                    'role_id'=>'2',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s") 
                ],                
                [
                    'name'=>'Neurocirugia',
                    'role_id'=>'2',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s") 
                ],                
                [
                    'name'=>'Nutricion',
                    'role_id'=>'2',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s") 
                ],                
                [
                    'name'=>'Oftalmologia',
                    'role_id'=>'2',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s") 
                ],                
                [
                    'name'=>'Oncologia',
                    'role_id'=>'2',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s") 
                ],                
                [
                    'name'=>'Ortopedia',
                    'role_id'=>'2',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s") 
                ],                
                [
                    'name'=>'Otorrinolaringologia',
                    'role_id'=>'2',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s") 
                ],                
                [
                    'name'=>'Pediatria',
                    'role_id'=>'2',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s") 
                ],                
                [
                    'name'=>'Patologia',
                    'role_id'=>'2',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s") 
                ],                
                [
                    'name'=>'Perinatologia',
                    'role_id'=>'2',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s") 
                ],                
                [
                    'name'=>'Proctologia',
                    'role_id'=>'2',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s") 
                ],                
                [
                    'name'=>'Psiquiatria',
                    'role_id'=>'2',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s") 
                ],                
                [
                    'name'=>'Radiologia',
                    'role_id'=>'2',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s") 
                ],                              
                [
                    'name'=>'Reumatologia',
                    'role_id'=>'2',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s") 
                ],                             
                [
                    'name'=>'Traumatologia',
                    'role_id'=>'2',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s") 
                ],                
                [
                    'name'=>'Urologia',
                    'role_id'=>'2',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s") 
                ],     
                [
                    'name'=>'Administrativo',
                    'role_id'=>'3',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ], 
                [
                    'name'=>'Citaciones (Administrativo)',
                    'role_id'=>'3',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'name'=>'Recepcionista (Administrativo)',
                    'role_id'=>'3',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s") 
                ],  
                [
                    'name'=>'Secretario/a (Administrativo)',
                    'role_id'=>'3',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s") 
                ],               
                [
                    'name'=>'Otros (P.Sanitario)',
                    'role_id'=>'3',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s") 
                ],                
                [
                    'name'=>'Otros (P.Administrativo)',
                    'role_id'=>'3',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s") 
                ],              
            ]
        );
    }
}
