<?php
return [

//https://developer.paypal.com/developer/applications/edit/QWFLbDFqZHU3NFB2eE9BcjRKdkMyeEp6a0c4cVdfV1ZHb24zNERxMENWRUxhSmpDWlBiUUh2OHJSd3BtUTJEYUV6YjJlb0NhTXhsNC1XX00=


   ////// Sandbox paypal credential
    'client_id' => env('PAYPAL_CLIENT_ID',''),
    'secret' => env('PAYPAL_SECRET',''),

    /**
    * SDK configuration
    */
    'settings' => array(
    /**
    * Available option 'sandbox' or 'live'
    */
    //'mode' => env('PAYPAL_MODE','live'),
    'mode' => env('PAYPAL_MODE',''),

    /**
    * Specify the max request time in seconds
    */
    'http.ConnectionTimeOut' => 30,

    /**
    * Whether want to log to a file
    */
    'log.LogEnabled' => true,

    /**
    * Specify the file that want to write on
    */
    'log.FileName' => storage_path() . '/logs/paypal.log',

    /**
    * Available option 'FINE', 'INFO', 'WARN' or 'ERROR'
    *
    * Logging is most verbose in the 'FINE' level and decreases as you
    * proceed towards ERROR
    */
    'log.LogLevel' => 'ERROR'
    ),
];
