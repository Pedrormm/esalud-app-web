<?php

namespace Database\Seeders;

use DB;
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
                    'name' => 'dashboard',
                    'permission_id' => 1,
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")                  
                ],
                [
                    'name' => 'user/newUser',
                    'permission_id' => 2,
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")  
                ],
                [
                    'name' => 'users',
                    'permission_id' => 3,
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")  
                ],
                [
                    'name' => 'users/{number}/edit',
                    'permission_id' => 4,
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")  
                ],
                [
                    'name' => 'users/{number}/confirmDelete',
                    'permission_id' => 5,
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")  
                ],
                [
                    'name' => 'patients',
                    'permission_id' => 6,
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")  
                ],
                [
                    'name' => 'patients/{number}/edit',
                    'permission_id' => 7,
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")  
                ],
                [
                    'name' => 'patients/{number}/confirmDelete',
                    'permission_id' => 8,
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")  
                ],
                [
                    'name' => 'staff',
                    'permission_id' => 9,
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")  
                ],
                [
                    'name' => 'staff/{number}/edit',
                    'permission_id' => 10,
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")  
                ],
                [
                    'name' => 'staff/{number}/confirmDelete',
                    'permission_id' => 11,
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")  
                ],
                [
                    'name' => 'records',
                    'permission_id' => 12,
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")  
                ],
                [
                    'name' => 'ownRecord',
                    'permission_id' => 13,
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")  
                ],
                [
                    'name' => 'comm/messaging',
                    'permission_id' => 22,
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")  
                ],
                [
                    'name' => 'user/video-call',
                    'permission_id' => 23,
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")  
                ],
                [
                    'name' => 'openvidu/token',
                    'permission_id' => 24,
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")  
                ],
                [
                    'name' => 'appointment/create',
                    'permission_id' => 14,
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")  
                ],
                [
                    'name' => 'appointment/create',
                    'permission_id' => 15,
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")  
                ],
                [
                    'name' => 'appointment/create',
                    'permission_id' => 16,
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")  
                ],
                [
                    'name' => 'appointment/list/pending',
                    'permission_id' => 20,
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")  
                ],
                [
                    'name' => 'appointment/list/accepted',
                    'permission_id' => 19,
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")  
                ],
                [
                    'name' => 'appointment',
                    'permission_id' => 18,
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")  
                ],
                [
                    'name' => 'appointment',
                    'permission_id' => 17,
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")  
                ],
                [
                    'name' => 'appointment/calendar',
                    'permission_id' => 21,
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")  
                ],
            ]

        );
        
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
