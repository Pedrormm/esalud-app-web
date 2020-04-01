<?php

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
        
        DB::table('specialities_staff')->insert(
            [
                [
                    'staff_id'=>3,
                    'speciality_id'=>1,
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'staff_id'=>4,
                    'speciality_id'=>1,
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'staff_id'=>5,
                    'speciality_id'=>1,
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'staff_id'=>1,
                    'speciality_id'=>10,
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'staff_id'=>2,
                    'speciality_id'=>9,
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],                
                [
                    'staff_id'=>6,
                    'speciality_id'=>11,
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],                
                [
                    'staff_id'=>7,
                    'speciality_id'=>10,
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],                
                [
                    'staff_id'=>8,
                    'speciality_id'=>3,
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],                
                [
                    'staff_id'=>9,
                    'speciality_id'=>20,
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'staff_id'=>10,
                    'speciality_id'=>23,
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
            ]
        );
        
    }
}
