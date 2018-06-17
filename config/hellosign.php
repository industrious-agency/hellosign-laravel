<?php

return [

    'test_mode' => env('HELLOSIGN_TEST_MODE', false),

    /*
     *
     */
    'authentication' => [

        //  Method can be either 'key', 'email' or 'oauth'
        'method' => env('HELLOSIGN_API_METHOD', 'key'),

        'params' => [
            //  Required for 'api' method
            'api_key' => env('HELLOSIGN_API_KEY'),

            //  Required for 'email' method
            'email' => env('HELLOSIGN_API_EMAIL'),
            'password' => env('HELLOSIGN_API_PASSWORD'),

            //  Required for 'oauth' method
            'oauth_token' => env('HELLOSIGN_API_OAUTH_TOKEN'),
        ],
    ],

];
