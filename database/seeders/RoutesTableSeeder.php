<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class RoutesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        
        \DB::table('routes')->insert(

            [
                [
                    'name' => 'Uso cutáneo',
                    'permission_id' => 1,
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")                  
                ],
                [
                    'name' => 'Parche transdérmico',
                    'permission_id' => 1,
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")  
                ],
                [
                    'name' => 'Vía oral',
                    'permission_id' => 1,
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")  
                ],
                [
                    'name' => 'Vía nasal',
                    'permission_id' => 1,
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")  
                ],
                [
                    'name' => 'Vía rectal',
                    'permission_id' => 1,
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")  
                ],
                [
                    'name' => 'Vía vaginal',
                    'permission_id' => 1,
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")  
                ],
                [
                    'name' => 'Vía sublingual',
                    'permission_id' => 1,
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")  
                ],
                [
                    'name' => 'Vía bucal',
                    'permission_id' => 1,
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")  
                ],
                [
                    'name' => 'Vía ocular',
                    'permission_id' => 1,
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")  
                ],
                [
                    'name' => 'Vía ótica',
                    'permission_id' => 1,
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")  
                ],
                [
                    'name' => 'Vía intravenosa',
                    'permission_id' => 1,
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")  
                ],
                [
                    'name' => 'Vía intramuscular',
                    'permission_id' => 1,
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")  
                ],
                [
                    'name' => 'Vía intratecal',
                    'permission_id' => 1,
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")  
                ],
                [
                    'name' => 'Vía subcutánea',
                    'permission_id' => 1,
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")  
                ],
                [
                    'name' => 'Por inhalación',
                    'permission_id' => 1,
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")  
                ],
                [
                    'name' => 'Por nebulización',
                    'permission_id' => 1,
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")  
                ],
            ]

        );
        
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
