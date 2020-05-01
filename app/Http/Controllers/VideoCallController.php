<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;
use \Pusher\Pusher;

class VideoCallController extends Controller
{
    public function showVideoCall(){
        $authUser = Auth::user();

        return view('communication/video_call', ['user' => $authUser]);
    }

    public function authenticatePusher(Request $request){
        // Initialize the pusher object. Get the socket ID from the request
        $socketId = $request->socket_id;
        $channelName = $request->channel_name;
        //dd($request);

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
