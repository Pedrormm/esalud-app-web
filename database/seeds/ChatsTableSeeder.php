<?php

use Illuminate\Database\Seeder;

class ChatsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('chats')->insert(
            [
                [
                    'id'=>1,
                    'user_id_user_A'=>1,
                    'user_id_user_B'=>5,
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'id'=>2,
                    'user_id_user_A'=>5,
                    'user_id_user_B'=>1,
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'id'=>3,
                    'user_id_user_A'=>1,
                    'user_id_user_B'=>10,
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'id'=>4,
                    'user_id_user_A'=>10,
                    'user_id_user_B'=>1,
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s") 
                ],
                [
                    'id'=>5,
                    'user_id_user_A'=>1,
                    'user_id_user_B'=>3,
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'id'=>6,
                    'user_id_user_A'=>3,
                    'user_id_user_B'=>1,
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'id'=>7,
                    'user_id_user_A'=>1,
                    'user_id_user_B'=>11,
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'id'=>8,
                    'user_id_user_A'=>11,
                    'user_id_user_B'=>1,
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s") 
                ],
                [
                    'id'=>9,
                    'user_id_user_A'=>1,
                    'user_id_user_B'=>14,
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'id'=>10,
                    'user_id_user_A'=>14,
                    'user_id_user_B'=>1,
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'id'=>11,
                    'user_id_user_A'=>1,
                    'user_id_user_B'=>2,
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'id'=>12,
                    'user_id_user_A'=>2,
                    'user_id_user_B'=>1,
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s") 
                ],
                [
                    'id'=>13,
                    'user_id_user_A'=>2,
                    'user_id_user_B'=>4,
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'id'=>14,
                    'user_id_user_A'=>4,
                    'user_id_user_B'=>2,
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'id'=>15,
                    'user_id_user_A'=>10,
                    'user_id_user_B'=>2,
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ],
                [
                    'id'=>16,
                    'user_id_user_A'=>2,
                    'user_id_user_B'=>10,
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s") 
                ],
            ]
        );
    }
}
