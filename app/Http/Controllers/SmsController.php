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
        $sid = 'AC1cbae40a187c162d519807048dc08aba';
        $token = '7e26293da3c48f976461c05bbc755be6';
        
        $client = new Client($sid, $token);

        // Using the client to do fun stuff like send text messages!
        // $response = $client->messages->create(
        //     $to ,
        //     [
        //         'from' => '+13392300029', 
        //         'body' => $body
        //     ]
        // );

        dump($to);
        dump($body);
        die();

        if(!$response) {
            return back()->withErrors("Error interno");
        }
        else{
            return back()->with('success', 'Messages has been queued and ready to be sent.');
        }
    }
}
