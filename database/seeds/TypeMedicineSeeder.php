<?php

use Illuminate\Database\Seeder;

class TypeMedicineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('type_medicines')->delete();
        
        \DB::table('type_medicines')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => "Lopinavir",                
            ),
            1 => 
            array (
                'id' => 2,
                'name' => "Ciprofloxacina",
            ),
            2 => 
            array (
                'id' => 3,
                'name' => "Ibuprofeno",                
            )
        ));
    }
}
