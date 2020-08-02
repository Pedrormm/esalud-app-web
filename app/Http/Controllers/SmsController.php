<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Twilio\Rest\Client;

class SmsController extends Controller
{
    public function sendsms()
    {
        return view('communication/sendsms');
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
            return back()->withErrors("Error interno");
        }
        else{
            return back()->with('js_code', 'showInlineMessage("Messages has been queued and ready to be sent",8)');
        }
    }
}
