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
        ->select('messages.*', 'users.id', 
        'users.dni', 'users.sex', 'users.name', 'users.lastname', 'users.rol')
        ->where('user_id_to', $authUser->id)
        ->orderBy('messages.read')
        ->orderByDesc('messages.created_at')
        ->get();

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

        $auxMessages = collect();
        $processedIds = [];
        foreach($userMessages as $i=>$userMessage) {
            if (!in_array($userMessage->user_id_from, $processedIds)){
                $processedIds[] = $userMessage->user_id_from;
                $auxMessages->push($userMessage);                
            }
        }

        $auxMessages = $auxMessages->toArray();
        return view('communication/my_messages', ['userMessages' => $auxMessages,'user' => $authUser]);
    }


    public function showMessagesFromUser($id){
        $authUser = Auth::user();
        $userIdFromTo = [$authUser->id, $id];
        $userMessages = Message::leftjoin('users', 'messages.user_id_from', 'users.id')
        ->select('messages.*', 'users.id', 'users.dni', 'users.sex', 'users.name', 'users.lastname', 'users.rol')
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

        $userFrom = Message::join('users', 'messages.user_id_from', 'users.id')
        ->where('user_id_from', $id)
        ->first();
        $userFrom->name = urldecode($userFrom->name);
        $userFrom->lastname = urldecode($userFrom->lastname);

        
        return view('communication/my_messages_from_user', ['userMessages' => $userMessages,'user' => $authUser,
        'userFrom' => $userFrom]);
    }


    public function sendMessage(){
        $user = Auth::user();

        $message = $user->messages()->create([
            'message' => $request->input('message')
        ]);

        return ['status' => 'Mensaje enviado'];
    }



}
