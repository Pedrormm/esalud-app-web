<?php

namespace Database\Seeders;
use DB;
use Illuminate\Database\Seeder;
class SpecialitiesStaffTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        DB::table('specialities_staff')->insert(
            [
                [
                    'staff_id'=>3,
                    'branches_id'=>1,
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'staff_id'=>4,
                    'branches_id'=>1,
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'staff_id'=>5,
                    'branches_id'=>1,
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'staff_id'=>1,
                    'branches_id'=>10,
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'staff_id'=>2,
                    'branches_id'=>9,
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],                
                [
                    'staff_id'=>6,
                    'branches_id'=>11,
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],                
                [
                    'staff_id'=>7,
                    'branches_id'=>10,
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],                
                [
                    'staff_id'=>8,
                    'branches_id'=>3,
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],                
                [
                    'staff_id'=>9,
                    'branches_id'=>20,
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'staff_id'=>10,
                    'branches_id'=>23,
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
            ]
        );

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        
    }
}
