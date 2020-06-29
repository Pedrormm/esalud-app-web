<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Message;
use App\Models\User;
use DB;
use App\Custom\PusherFactory;


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
        // Adding a lastMessageDate field to contact collection

        $contacts = DB::table("users_with_messages_view")
        ->select(\DB::raw('id, dni, sex, name, lastname, email, phone, avatar, MAX(`message_date`) as message_date'))
        ->where('id', '!=', auth()->id())
        ->groupBy('id')
        ->orderByDesc(\DB::raw("MAX(message_date)"))
        ->get();

        $userMessages = Message::join('users', 'messages.user_id_from', 'users.id')->orderBy('messages.read')
        ->where('user_id_to', auth()->id())->get();

        // Get a collection of items where sender_id is the user who sent us a message
        // and messages_count is the number of unread messages we have from him
        $unreadIds = Message::select(\DB::raw('`user_id_from` as sender_id, count(`user_id_from`) as messages_count'))
            ->where('user_id_to', auth()->id())
            ->where('read', false)
            ->groupBy('user_id_from')
            ->get();

        // Add an unread key to each contact with the count of unread messages
        $contacts = $contacts->map(function($contact) use ($unreadIds) {
            $contactUnread = $unreadIds->where('sender_id', $contact->id)->first();

            $contact->unread = $contactUnread ? $contactUnread->messages_count : 0;

            return $contact;
        });

        return view('communication/messaging', ['contacts' => $contacts]);
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
            // ->update(['read' => true])
            ->get();

            // $messages_from_user->each(function($item, $key) {
            //     if (($item->read == false) && ($item->user_id_to == auth()->id()) ){
            //         $item->read = true;
            //         $item->save();
            //     }
            // });

            // dd($messages_from_user->toArray());

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
        Message::where('user_id_from', $id)->where('user_id_to', auth()->id())->update(['read' => true]);

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

    public function viewMessagesFromMobile($id){

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

        return view('communication/view_messages_from_mobile', ['userFound' => $user_to_be_found,
        'userMessages' => $messages_from_user]);
    }

    public function send(Request $request)
    {
        if($request->ajax()) {

            $text = $request->msj;
            $contact_id = (int)$request->contact_id;

            $message = Message::create([
                'user_id_from' => auth()->id(),
                'user_id_to' => $contact_id,
                'message' => $text
            ]);

            // $message->log = PusherFactory::make()->trigger('chat', 'send', ['data' => $message]);
            
            // broadcast(new NewMessage($message));

            return response()->json($message);
        }
    }
    



}