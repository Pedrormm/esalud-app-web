<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Twilio\Rest\Client;

class SmsController extends Controller
{
    public function sendsms(Request $request)
    {
        switch ($request->method()) {
            case 'POST':
                return ($this->postSendSms($request));
                break;
    
            case 'GET':
                return view('communication/sendsms');
                break;
    
            default:
                // invalid request
                break;
        }
    }

    public function postSendSms(Request $request)
    {
        $request->validate([
            'to' => 'required',
            'messages' => 'required',
        ]);
        $to = request('to');
        $body = request('messages');

        // Using the REST API Client to make requests to the Twilio REST API
        $sid = config('app.twilio_sid');
        $token = config('app.twilio_token');
        $number = config('app.twilio_number');

        $client = new Client($sid, $token);

        // $response = $client->messages->create(
        //     $to ,
        //     [
        //         'from' => $number, 
        //         'body' => $body
        //     ]
        // );

        $response ="a";

        if(!$response) {
            return back()->withErrors(\Lang::get('messages.internal_error'));
        }
        else{
            return back()->with('js_code', 'showInlineMessage("_messagesLocalization.messages_have_been_queued_and_are_ready_to_be_sent",8)');
        }
    }
}
