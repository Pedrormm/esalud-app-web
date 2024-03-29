<?php

namespace Database\Seeders;
use DB;
use Illuminate\Database\Seeder;
class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        DB::table('roles')->insert(
            [
                [
                    'id'=>1,
                    'name'=>'Patient',
                    'user_id_creator'=>1,
                    'delible'=>1,
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'id'=>2,
                    'name'=>'Doctor',
                    'user_id_creator'=>1,
                    'delible'=>1,
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'id'=>3,
                    'name'=>'Helper',
                    'user_id_creator'=>1,
                    'delible'=>1,
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'id'=>4,
                    'name'=>'Admin',
                    'user_id_creator'=>1,
                    'delible'=>1,
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s") 
                ],
                [
                    'id'=>5,
                    'name'=>'Guest',
                    'user_id_creator'=>1,
                    'delible'=>1,
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s") 
                ],
            ]
        );

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

    }
}
