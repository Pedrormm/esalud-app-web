<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Message;
class MessageController extends Controller
{
    const MAX_MESSAGE_LENGTH = 15;
    public function get() {
        $authUser = Auth::user();
        $userMessages = Message::where('to', $authUser->id)->orderByDesc('sent')->get();
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
}
