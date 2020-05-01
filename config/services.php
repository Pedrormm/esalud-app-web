<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */
    'sendgrid' => [
        'api_key' => env('SENDGRID_API_KEY'),
    ],
    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'openvidu' => [
        'app' => env('OPENVIDU_APP'), //At the moment, always "OPENVIDUAPP"
        'domain' => env('OPENVIDU_DOMAIN'), //Your OpenVidu Server machine public IP
        'port' => env('OPENVIDU_PORT'), //Listening port of your OpenVidu server, default 4443
        'secret' => env('OPENVIDU_SECRET'), //The password used to secure your OpenVidu Server
        'debug' => env('OPENVIDU_DEBUG') // true or false
    ]

];
