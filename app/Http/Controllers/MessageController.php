<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Message;
use App\Models\User;
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
        'users.dni', 'users.sex', 'users.name', 'users.lastname', 'users.role_id')
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
        ->select('messages.*', 'users.id', 'users.dni', 'users.sex', 'users.name', 'users.lastname', 'users.role_id')
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


    public function showMessaging(){
        $userMessages = Message::join('users', 'messages.user_id_from', 'users.id')
        ->select('messages.*', 'users.id', 
        'users.dni', 'users.sex', 'users.name', 'users.lastname', 'users.role_id')
        ->where('user_id_to', auth()->id())
        ->orderBy('messages.read')
        ->orderByDesc('messages.created_at')
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

        $auxMessages = collect();
        $processedIds = [];
        foreach($userMessages as $i=>$userMessage) {
            if (!in_array($userMessage->user_id_from, $processedIds)){
                $processedIds[] = $userMessage->user_id_from;
                $auxMessages->push($userMessage);                
            }
        }
        $last_messages_to_logged_user = $auxMessages->toArray();

        $auxMessages = $auxMessages->toArray();
        $messages = []; //List of messages

        //Array of contacts. Get all users except the authenticated one
        $contacts = User::select('users.id', 'users.dni', 'users.sex', 'users.name', 'users.lastname', 'users.email', 'users.phone', 'users.avatar')
        ->where('id', '!=', auth()->id())->get();

        // Get a collection of items where sender_id is the user who sent us a message
        // and messages_count is the number of unread messages we have from him
        $unreadIds = Message::select(\DB::raw('`user_id_from` as sender_id, count(`user_id_from`) as messages_count'))
            ->where('user_id_to', auth()->id())
            ->where('read', 0)
            ->groupBy('user_id_from')
            ->get();

        // dd($unreadIds->toArray());

        // Add an unread key to each contact with the count of unread messages
        $contacts = $contacts->map(function($contact) use ($unreadIds) {
            $contactUnread = $unreadIds->where('sender_id', $contact->id)->first();

            $contact->unread = $contactUnread ? $contactUnread->messages_count : 0;

            return $contact;
        });

        // dd($contacts->toArray());
        return view('communication/messaging', ['userMessages' => $auxMessages,
        'messages' => $messages, 'contacts' => $contacts]);
    }

    public function getContactInfo(Request $request){
        if($request->ajax()) {

            $id = $request->id;
            $user_to_be_found = User::select('users.id', 'users.dni', 'users.sex', 'users.name', 
            'users.lastname', 'users.email', 'users.phone', 'users.avatar')
            ->where('id', $id)->get();

            // dd($user_to_be_found->toArray());

            // Get all messages between the authenticated user and the selected user
            $messages_from_user = Message::where(function($q) use ($id) {
                $q->where('user_id_from', auth()->id());
                $q->where('user_id_to', $id);
            })->orWhere(function($q) use ($id) {
                $q->where('user_id_from', $id);
                $q->where('user_id_to', auth()->id());
            })
            ->get();

            // dd($messages->toArray());

            // Messages from the Request user id to the auth user Id
            $response = [
                'user_to_be_found' => $user_to_be_found,
                'messages_from_user' => $messages_from_user
            ];
            return response()->json($response);
        }
    }


    public function getMessagesFor($id)
    {
        // Mark all messages with the selected contact as read
        Message::where('user_id_from', $id)->where('user_id_to', auth()->id())->update(['read' => 1]);

        // Get all messages between the authenticated user and the selected user
        $messages = Message::where(function($q) use ($id) {
            $q->where('user_id_from', auth()->id());
            $q->where('user_id_to', $id);
        })->orWhere(function($q) use ($id) {
            $q->where('user_id_from', $id);
            $q->where('user_id_to', auth()->id());
        })
        ->get();

        return response()->json($messages);
    }

    public function viewMessagesFrom($id){

        $user_to_be_found = User::select('users.id', 'users.dni', 'users.sex', 'users.name', 
        'users.lastname', 'users.email', 'users.phone', 'users.avatar')
        ->where('id', $id)->get()->toArray();

        // dd($user_to_be_found->toArray());

        // Get all messages between the authenticated user and the selected user
        $messages_from_user = Message::where(function($q) use ($id) {
            $q->where('user_id_from', auth()->id());
            $q->where('user_id_to', $id);
        })->orWhere(function($q) use ($id) {
            $q->where('user_id_from', $id);
            $q->where('user_id_to', auth()->id());
        })
        ->get()->toArray();

        // dd($messages_from_user->toArray());        

        return view('communication/view_messages_from', ['userFound' => $user_to_be_found,
        'userMessages' => $messages_from_user]);
    }

    public function send(Request $request)
    {
        $message = Message::create([
            'user_id_from' => auth()->id(),
            'user_id_to' => $request->contact_id,
            'message' => $request->message
        ]);

        broadcast(new NewMessage($message));

        return response()->json($message);
    }
    



}