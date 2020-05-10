<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;
use \Pusher\Pusher;
use App\Models\User;


class VideoCallController extends Controller
{
    public function showVideoCall(){
        $authUser = Auth::user();
        // $allUsers = User::select('id','name','lastname', 'role_id')->orderBy('users.id')->get()->toArray();

        $allUsers = User::select('users.id','users.name','lastname','dni','role_id','roles.name as role_name')
        ->join('roles', 'roles.id', 'users.role_id')->orderBy('users.id')->get()->groupBy('role_name')->toArray();


    //     <select 
    //     className="selectpicker" data-live-search="true"              
    //    data-header="Busque por nombre o apellidos"
    //    onChange={(e) => this.selectUser(e)} 
    //    >
    //         { this.users.map((user) => {
    //         return this.user.id !== user.id ? <option key={ user.id } value={ user.id }>
    //             { user.name } { user.lastname }</option> : null;
    //         })}
    //     </select> 
        
        return view('communication/video_call', ['allUsers' => json_encode($allUsers),'user' => $authUser]);
    }

    public function authenticatePusher(Request $request){
        // Initialize the pusher object. Get the socket ID from the request
        $socketId = $request->socket_id;
        $channelName = $request->channel_name;

        // Pusher instance parameters: ('App key', 'App secret', 'App id', [options array])
        $pusher = new Pusher('9e2cbb3bb69dab826cef', 'fb08e67b0ea85827f74f', '984941', [
            'cluster' => 'ap2',
            'encrypted' => true
        ]);

        // The pusher will hold this info
        $presence_data = ['name' => auth()->user()->name];
        // key that will be sent to the response to the pusher 
        $key = $pusher->presence_auth($channelName, $socketId, auth()->id(), $presence_data);

        return response($key);
    }

    
}
