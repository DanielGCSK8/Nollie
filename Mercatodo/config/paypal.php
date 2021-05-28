<?php

return [
   
    'base_uri' => env('PAYPAL_BASE_URL'),

    
    'client_id' => env('PAYPAL_CLIENT_ID'),

    
    'client_secret' => env('PAYPAL_CLIENT_SECRET'),

    'settings' => [
        'mode' => env('PAYPAL_MODE', 'sandbox'),
        'http.ConnectionTimeOut' => 30,
        'log.LogEnabled' => true,
        'log.FileName' => storage_path('/logs/paypal.log'),
        'loog.LogLevel' => 'ERROR'

    ]

];