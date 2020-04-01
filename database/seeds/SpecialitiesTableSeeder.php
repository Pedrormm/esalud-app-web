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

        DB::table('specialities')->insert(
            [
                [
                    'speciality_name'=>'Administrativo',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'speciality_name'=>'Alergologia',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'speciality_name'=>'Anestesiologia',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'speciality_name'=>'Angiologia',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s") 
                ],
                [
                    'speciality_name'=>'Bariatria',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'speciality_name'=>'Cardiologia',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'speciality_name'=>'Cirugia General',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'speciality_name'=>'Cirugia Maxilofacial',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s") 
                ],
                [
                    'speciality_name'=>'Cirugia Plastica',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'speciality_name'=>'Cirugia Estetica',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'speciality_name'=>'Citaciones (Administrativo)',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'speciality_name'=>'Dermatologia',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s") 
                ],
                [
                    'speciality_name'=>'Enocrinologia',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'speciality_name'=>'Endoscopia',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'speciality_name'=>'Fisiatria',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'speciality_name'=>'Gastroenterologia',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s") 
                ],
                [
                    'speciality_name'=>'Geriatria',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'speciality_name'=>'Ginecologia',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'speciality_name'=>'Hematologia',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'speciality_name'=>'Infectologia',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s") 
                ],
                [
                    'speciality_name'=>'Inmunologia',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s") 
                ],                
                [
                    'speciality_name'=>'Medicina general',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s") 
                ],                
                [
                    'speciality_name'=>'Microcirugia',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s") 
                ],                
                [
                    'speciality_name'=>'Nefrologia',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s") 
                ],                
                [
                    'speciality_name'=>'Neonatologia',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s") 
                ],                
                [
                    'speciality_name'=>'Neumologia',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s") 
                ],                
                [
                    'speciality_name'=>'Neurologia',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s") 
                ],                
                [
                    'speciality_name'=>'Neurocirugia',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s") 
                ],                
                [
                    'speciality_name'=>'Nutricion',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s") 
                ],                
                [
                    'speciality_name'=>'Oftalmologia',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s") 
                ],                
                [
                    'speciality_name'=>'Oncologia',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s") 
                ],                
                [
                    'speciality_name'=>'Ortopedia',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s") 
                ],                
                [
                    'speciality_name'=>'Otorrinolaringologia',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s") 
                ],                
                [
                    'speciality_name'=>'Pediatria',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s") 
                ],                
                [
                    'speciality_name'=>'Patologia',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s") 
                ],                
                [
                    'speciality_name'=>'Perinatologia',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s") 
                ],                
                [
                    'speciality_name'=>'Proctologia',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s") 
                ],                
                [
                    'speciality_name'=>'Psiquiatria',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s") 
                ],                
                [
                    'speciality_name'=>'Radiologia',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s") 
                ],                
                [
                    'speciality_name'=>'Recepcionista (Administrativo)',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s") 
                ],                
                [
                    'speciality_name'=>'Reumatologia',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s") 
                ],                
                [
                    'speciality_name'=>'Secretario/a (Administrativo)',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s") 
                ],                
                [
                    'speciality_name'=>'Traumatologia',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s") 
                ],                
                [
                    'speciality_name'=>'Urologia',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s") 
                ],                
                [
                    'speciality_name'=>'Otros (P.Sanitario)',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s") 
                ],                
                [
                    'speciality_name'=>'Otros (P.Administrativo)',
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s") 
                ],                
            ]
        );
    }
}
