<?php

use Illuminate\Database\Seeder;

class AnalyticsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('analytics')->insert(
            [
                [
                    'id'=>2,
                    'type'=>1,
                    'user_id_user'=>10,
                    'user_id_creator'=>2,
                    'result'=>'{"1":"0.27","2":"0.59","3":"6.33","4":"6.21","5":"9.26"}',
                    'deleted_at'=>date("Y-m-d H:i:s"),
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'id'=>3,
                    'type'=>2,
                    'user_id_user'=>10,
                    'user_id_creator'=>2,
                    'result'=>'{"1":"900","2":"99.3689","3":"23.55"}',
                    'deleted_at'=>null,
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'id'=>4,
                    'type'=>1,
                    'user_id_user'=>10,
                    'user_id_creator'=>2,
                    'result'=>'{"1":"0.334","2":"25","3":"2.66","4":"33","5":"55"}',
                    'deleted_at'=>date("Y-m-d H:i:s"),
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'id'=>6,
                    'type'=>1,
                    'user_id_user'=>10,
                    'user_id_creator'=>2,
                    'result'=>'{"1":"55","2":"44","3":"33","4":"12","5":"8"}',
                    'deleted_at'=>date("Y-m-d H:i:s"),
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'id'=>7,
                    'type'=>1,
                    'user_id_user'=>10,
                    'user_id_creator'=>2,
                    'result'=>'{"1":"55555500","2":"44","3":"33","4":"12","5":"8"}',
                    'deleted_at'=>date("Y-m-d H:i:s"),
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'id'=>8,
                    'type'=>2,
                    'user_id_user'=>10,
                    'user_id_creator'=>2,
                    'result'=>'{"1":"55","2":"115","3":"0.15"}',
                    'deleted_at'=>null,
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'id'=>9,
                    'type'=>2,
                    'user_id_user'=>10,
                    'user_id_creator'=>2,
                    'result'=>'{"1":"12","2":"44","3":"8745"}',
                    'deleted_at'=>null,
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'id'=>10,
                    'type'=>1,
                    'user_id_user'=>10,
                    'user_id_creator'=>2,
                    'result'=>'{"1":"22","2":"118","3":"22","4":"78","5":"55"}',
                    'deleted_at'=>null,
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'id'=>11,
                    'type'=>2,
                    'user_id_user'=>10,
                    'user_id_creator'=>2,
                    'result'=>'{"1":"55","2":"44","3":"11"}',
                    'deleted_at'=>null,
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'id'=>12,
                    'type'=>2,
                    'user_id_user'=>10,
                    'user_id_creator'=>2,
                    'result'=>'{"1":"1","2":"2","3":"3"}',
                    'deleted_at'=>null,
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'id'=>13,
                    'type'=>1,
                    'user_id_user'=>10,
                    'user_id_creator'=>2,
                    'result'=>'{"1":"1","2":"2","3":"3","4":"4","5":"5"}',
                    'deleted_at'=>null,
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'id'=>14,
                    'type'=>1,
                    'user_id_user'=>10,
                    'user_id_creator'=>2,
                    'result'=>'{"1":"6","2":"7","3":"8","4":"9","5":"10"}',
                    'deleted_at'=>date("Y-m-d H:i:s"),
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'id'=>15,
                    'type'=>1,
                    'user_id_user'=>10,
                    'user_id_creator'=>2,
                    'result'=>'{"1":"8","2":"44","3":"55","4":"22","5":"11"}',
                    'deleted_at'=>null,
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
            ]
        );
    }
}
