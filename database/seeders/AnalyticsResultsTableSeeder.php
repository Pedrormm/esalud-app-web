<?php

namespace Database\Seeders;
use DB;
use Illuminate\Database\Seeder;
class AnalyticsResultsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // DB::table('analytics_results')->insert(
        //     [
        //         // [
        //         //     'id'=>2,
        //         //     'type'=>1,
        //         //     'user_id_user'=>10,
        //         //     'user_id_creator'=>2,
        //         //     'result'=>'{"1":"0.27","2":"0.59","3":"6.33","4":"6.21","5":"9.26"}',
        //         //     'deleted_at'=>date("Y-m-d H:i:s"),
        //         // ],
        //         [
        //             'id'=>2,
        //             'name'=>'Doctor',
        //             'user_id_creator'=>1,
        //             'created_at'=> date("Y-m-d H:i:s"),
        //             'updated_at'=> date("Y-m-d H:i:s")
        //         ],
        //         [
        //             'id'=>3,
        //             'name'=>'Helper',
        //             'user_id_creator'=>1,
        //             'created_at'=> date("Y-m-d H:i:s"),
        //             'updated_at'=> date("Y-m-d H:i:s")
        //         ],
        //         [
        //             'id'=>4,
        //             'name'=>'Admin',
        //             'user_id_creator'=>1,
        //             'created_at'=> date("Y-m-d H:i:s"),
        //             'updated_at'=> date("Y-m-d H:i:s") 
        //         ],
        //         [
        //             'id'=>1,
        //             'name'=>'Patient',
        //             'user_id_creator'=>1,
        //             'created_at'=> date("Y-m-d H:i:s"),
        //             'updated_at'=> date("Y-m-d H:i:s")
        //         ],
        //         [
        //             'id'=>2,
        //             'name'=>'Doctor',
        //             'user_id_creator'=>1,
        //             'created_at'=> date("Y-m-d H:i:s"),
        //             'updated_at'=> date("Y-m-d H:i:s")
        //         ],
        //         [
        //             'id'=>3,
        //             'name'=>'Helper',
        //             'user_id_creator'=>1,
        //             'created_at'=> date("Y-m-d H:i:s"),
        //             'updated_at'=> date("Y-m-d H:i:s")
        //         ],
        //         [
        //             'id'=>4,
        //             'name'=>'Admin',
        //             'user_id_creator'=>1,
        //             'created_at'=> date("Y-m-d H:i:s"),
        //             'updated_at'=> date("Y-m-d H:i:s") 
        //         ],
        //         [
        //             'id'=>1,
        //             'name'=>'Patient',
        //             'user_id_creator'=>1,
        //             'created_at'=> date("Y-m-d H:i:s"),
        //             'updated_at'=> date("Y-m-d H:i:s")
        //         ],
        //         [
        //             'id'=>2,
        //             'name'=>'Doctor',
        //             'user_id_creator'=>1,
        //             'created_at'=> date("Y-m-d H:i:s"),
        //             'updated_at'=> date("Y-m-d H:i:s")
        //         ],
        //         [
        //             'id'=>3,
        //             'name'=>'Helper',
        //             'user_id_creator'=>1,
        //             'created_at'=> date("Y-m-d H:i:s"),
        //             'updated_at'=> date("Y-m-d H:i:s")
        //         ],
        //         [
        //             'id'=>4,
        //             'name'=>'Admin',
        //             'user_id_creator'=>1,
        //             'created_at'=> date("Y-m-d H:i:s"),
        //             'updated_at'=> date("Y-m-d H:i:s") 
        //         ],
        //         [
        //             'id'=>1,
        //             'name'=>'Patient',
        //             'user_id_creator'=>1,
        //             'created_at'=> date("Y-m-d H:i:s"),
        //             'updated_at'=> date("Y-m-d H:i:s")
        //         ],
        //         [
        //             'id'=>2,
        //             'name'=>'Doctor',
        //             'user_id_creator'=>1,
        //             'created_at'=> date("Y-m-d H:i:s"),
        //             'updated_at'=> date("Y-m-d H:i:s")
        //         ],
        //         [
        //             'id'=>3,
        //             'name'=>'Helper',
        //             'user_id_creator'=>1,
        //             'created_at'=> date("Y-m-d H:i:s"),
        //             'updated_at'=> date("Y-m-d H:i:s")
        //         ],
        //         [
        //             'id'=>4,
        //             'name'=>'Admin',
        //             'user_id_creator'=>1,
        //             'created_at'=> date("Y-m-d H:i:s"),
        //             'updated_at'=> date("Y-m-d H:i:s") 
        //         ],
        //         [
        //             'id'=>1,
        //             'name'=>'Patient',
        //             'user_id_creator'=>1,
        //             'created_at'=> date("Y-m-d H:i:s"),
        //             'updated_at'=> date("Y-m-d H:i:s")
        //         ],
        //         [
        //             'id'=>2,
        //             'name'=>'Doctor',
        //             'user_id_creator'=>1,
        //             'created_at'=> date("Y-m-d H:i:s"),
        //             'updated_at'=> date("Y-m-d H:i:s")
        //         ],
        //         [
        //             'id'=>3,
        //             'name'=>'Helper',
        //             'user_id_creator'=>1,
        //             'created_at'=> date("Y-m-d H:i:s"),
        //             'updated_at'=> date("Y-m-d H:i:s")
        //         ],
        //         [
        //             'id'=>4,
        //             'name'=>'Admin',
        //             'user_id_creator'=>1,
        //             'created_at'=> date("Y-m-d H:i:s"),
        //             'updated_at'=> date("Y-m-d H:i:s") 
        //         ],
        //         [
        //             'id'=>1,
        //             'name'=>'Patient',
        //             'user_id_creator'=>1,
        //             'created_at'=> date("Y-m-d H:i:s"),
        //             'updated_at'=> date("Y-m-d H:i:s")
        //         ],
        //         [
        //             'id'=>2,
        //             'name'=>'Doctor',
        //             'user_id_creator'=>1,
        //             'created_at'=> date("Y-m-d H:i:s"),
        //             'updated_at'=> date("Y-m-d H:i:s")
        //         ],
        //         [
        //             'id'=>3,
        //             'name'=>'Helper',
        //             'user_id_creator'=>1,
        //             'created_at'=> date("Y-m-d H:i:s"),
        //             'updated_at'=> date("Y-m-d H:i:s")
        //         ],
        //         [
        //             'id'=>4,
        //             'name'=>'Admin',
        //             'user_id_creator'=>1,
        //             'created_at'=> date("Y-m-d H:i:s"),
        //             'updated_at'=> date("Y-m-d H:i:s") 
        //         ],
        //         [
        //             'id'=>1,
        //             'name'=>'Patient',
        //             'user_id_creator'=>1,
        //             'created_at'=> date("Y-m-d H:i:s"),
        //             'updated_at'=> date("Y-m-d H:i:s")
        //         ],
        //         [
        //             'id'=>2,
        //             'name'=>'Doctor',
        //             'user_id_creator'=>1,
        //             'created_at'=> date("Y-m-d H:i:s"),
        //             'updated_at'=> date("Y-m-d H:i:s")
        //         ],
        //         [
        //             'id'=>3,
        //             'name'=>'Helper',
        //             'user_id_creator'=>1,
        //             'created_at'=> date("Y-m-d H:i:s"),
        //             'updated_at'=> date("Y-m-d H:i:s")
        //         ],
        //         [
        //             'id'=>4,
        //             'name'=>'Admin',
        //             'user_id_creator'=>1,
        //             'created_at'=> date("Y-m-d H:i:s"),
        //             'updated_at'=> date("Y-m-d H:i:s") 
        //         ],
        //         [
        //             'id'=>1,
        //             'name'=>'Patient',
        //             'user_id_creator'=>1,
        //             'created_at'=> date("Y-m-d H:i:s"),
        //             'updated_at'=> date("Y-m-d H:i:s")
        //         ],
        //         [
        //             'id'=>2,
        //             'name'=>'Doctor',
        //             'user_id_creator'=>1,
        //             'created_at'=> date("Y-m-d H:i:s"),
        //             'updated_at'=> date("Y-m-d H:i:s")
        //         ],
        //         [
        //             'id'=>3,
        //             'name'=>'Helper',
        //             'user_id_creator'=>1,
        //             'created_at'=> date("Y-m-d H:i:s"),
        //             'updated_at'=> date("Y-m-d H:i:s")
        //         ],
        //         [
        //             'id'=>4,
        //             'name'=>'Admin',
        //             'user_id_creator'=>1,
        //             'created_at'=> date("Y-m-d H:i:s"),
        //             'updated_at'=> date("Y-m-d H:i:s") 
        //         ],
                
        //     ]
        // );
    }
}
