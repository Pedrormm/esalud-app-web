<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Message;
use DB;


class MessageController extends Controller
{
    const MAX_MESSAGE_LENGTH = 15;
    public function get() {
        $authUser = Auth::user();
        $userMessages = Message::where('user_id_to', $authUser->id)->orderByDesc('created_at')->get();
        foreach($userMessages as $i=>$userMessage) {
            $text = urldecode($userMessage->message);
            /*if(strlen($text) > self::MAX_MESSAGE_LENGTH) {
                $text = substr($text, 0, self::MAX_MESSAGE_LENGTH) . " ...";
            }*/
            $userMessage->messageCorrected = $text;
            $userMessages[$i] = $userMessage;
        }
        return view('ajax/messages', compact('userMessages'));
    }


    public function showIconMessage(){
        $authUser = Auth::user();
        $userMessages = Message::where('user_id_to', $authUser->id)->where('read', 0)
        ->orderByDesc('created_at')->get()->toArray();
        $nMessages = count($userMessages);
        return view('ajax.message_icon', compact('nMessages'));
    }

    public function showMessagesSummary(){
        $authUser = Auth::user();
        $userMessages = Message::join('users', 'messages.user_id_from', 'users.id')->orderBy('messages.read')
        ->where('user_id_to', $authUser->id)->get();
        foreach($userMessages as $i=>$userMessage) {
            $text = urldecode($userMessage->message);
            if(strlen($text) > self::MAX_MESSAGE_LENGTH) {
                $text = substr($text, 0, self::MAX_MESSAGE_LENGTH) . " ...";
            }
            $userMessage->messageCorrected = $text;
            $userMessages[$i] = $userMessage;
        }

        $userMessages = $userMessages->toArray();
        

        return view('ajax.messages_summary', compact('userMessages'));
    }

    const MAX_MY_MESSAGES_SHOWN_LENGTH = 25;    
    public function showMyMessages(){
        $authUser = Auth::user();
        $userMessages = Message::join('users', 'messages.user_id_from', 'users.id')
        ->where('user_id_to', $authUser->id)
        ->groupBy('users.dni')
        ->orderBy('messages.read')
        ->orderByDesc('messages.created_at')
        ->get();
/*
        $userMessages = Message::select(DB::raw('t.*'))
            ->from(DB::raw('(SELECT * FROM messages 
            INNER JOIN users ON messages.user_id_from = users.id) t'))
            ->groupBy('t.user_id_from')
            ->get();
*/

        // $userMessages= Message::selectRaw("users.id as userId, user_id_from, user_id_to, message, 
        // MIN(messages.read) AS minRead, name, lastname, dni, rol, messages.created_at, messages.updated_at")
        // ->join('users', 'messages.user_id_from', 'users.id')
        // ->where('user_id_to', $authUser->id)
        // ->groupBy('users.dni')->orderByDesc('created_at')->get();
        
        foreach($userMessages as $i=>$userMessage) {
            $text = urldecode($userMessage->message);
            $name = urldecode($userMessage->name);
            $lastname = urldecode($userMessage->lastname);
            /*if(strlen($text) > self::MAX_MY_MESSAGES_SHOWN_LENGTH) {
                $text = substr($text, 0, self::MAX_MY_MESSAGES_SHOWN_LENGTH) . " ...";
            }*/
            $userMessage->messageCorrected = $text;
            $userMessage->name = $name;
            $userMessage->lastname = $lastname;
            $userMessages[$i] = $userMessage;
        }

        $userMessages = $userMessages->toArray();
        //dd($userMessages);

        return view('communication/my_messages', ['userMessages' => $userMessages,'user' => $authUser]);
    }


    public function showMessagesFromUser($id){
        $authUser = Auth::user();
        $userIdFromTo = [$authUser->id, $id];
        $userMessages = Message::leftjoin('users', 'messages.user_id_from', 'users.id')
        ->select('messages.*', 'users.id', 'users.dni', 'users.name', 'users.lastname', 'users.rol')
        ->whereIn('user_id_to', $userIdFromTo)
        ->whereIn('user_id_from', $userIdFromTo)
        ->orderByDesc('messages.read')
        ->orderBy('messages.created_at')
        ->get();
        foreach($userMessages as $i=>$userMessage) {
            $text = urldecode($userMessage->message);
            $name = urldecode($userMessage->name);
            $lastname = urldecode($userMessage->lastname);
            $userMessage->messageCorrected = $text;
            $userMessage->name = $name;
            $userMessage->lastname = $lastname;
            $userMessages[$i] = $userMessage;
        }

        $userMessages = $userMessages->toArray();
        
        dd($userMessages);
        return view('communication/my_messages_from_user', ['userMessages' => $userMessages,'user' => $authUser]);
    }


    public function sendMessage(){
        $user = Auth::user();

        $message = $user->messages()->create([
            'message' => $request->input('message')
        ]);

        return ['status' => 'Mensaje enviado'];
    }



}
