<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;
use \Pusher\Pusher;
use App\Models\User;
use Response;



class VideoCallController extends Controller
{
    /**
     * @param $sessionRoom
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function showVideoRoom($sessionRoom){

        $loggedUser = auth()->user();

        return view('communication/video_room', ['loggedUser' => $loggedUser,
        'sessionRoom' => $sessionRoom]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function showVideoCall(Request $request){
        $allUsers = User::select('users.id','users.name','lastname','dni','role_id','roles.name as role_name')
        ->join('roles', 'roles.id', 'users.role_id')->orderBy('users.id')->get()->groupBy('role_name')->toArray();
        $signalSent="#";
        if($request->ajax()) {
            $signalSent= ($request->all());
            return view('communication/video_call_ajax', ['allUsers' => json_encode($allUsers),
            'signalSent' => $signalSent]);
        }
        // $usersIds = User::select("users.id", DB::raw("CONCAT(users.name,' ',users.lastname) as full_name"))
        // ->get();

        // // Making an associative array with keys->values
        // $usersIds = $usersIds->mapWithKeys(function ($item) {
        //     return [$item['id'] => $item['full_name']];
        // });

        // $usersIds = $usersIds->toArray();

        return view('communication/video_call', ['allUsers' => json_encode($allUsers),
        'signalSent' => $signalSent]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function showVideoCallContainer(Request $request){
        // $rules = [
        //     'userId' => 'numeric|min:1|exists:App\Models\User, id'
        // ];
        // dd(1);
        // dd($request->all());
        $userFullName = $request->userFullName;
        $sessionName = $request->sessionName;
        // dd($sessionName);

        $allUsers = User::select('users.id','users.name','lastname','dni','role_id','roles.name as role_name')
        ->join('roles', 'roles.id', 'users.role_id')->orderBy('users.id')->get()->groupBy('role_name')->toArray();

        // dd($allUsers);   
        $signalSent="#";
        if($request->ajax()) {

            return Response::json(array(
                'allUsers' => json_encode($allUsers),
                'signalSent' => $signalSent,
                'userFullName' => $userFullName,
                'sessionName' => $sessionName,
            ));

            // $signalSent= ($request->all());
            // return view('communication/video_call_ajax', ['allUsers' => json_encode($allUsers),
            // 'signalSent' => $signalSent, 'userFullName' => $userFullName, 'sessionName' => $sessionName]);
        }

        return view('communication/video_call_container', ['allUsers' => json_encode($allUsers),
        'signalSent' => $signalSent, 'userFullName' => $userFullName, 'sessionName' => $sessionName]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function getUserInfo(Request $request){
        if($request->ajax()) {
            $user_to_be_found = User::select(DB::raw("CONCAT(users.name,' ',users.lastname) as full_name"))
            ->where('id', $request->id)->get()->pluck('full_name');

            return Response($user_to_be_found[0]);
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     * @throws \Pusher\PusherException
     */
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
