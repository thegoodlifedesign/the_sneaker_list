<?php

if($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    header( "HTTP/1.1 200 OK" );
    exit();
}

return [

    /*
     |--------------------------------------------------------------------------
     | Laravel CORS Defaults
     |--------------------------------------------------------------------------
     |
     | The defaults are the default values applied to all the paths that match,
     | unless overridden in a specific URL configuration.
     | If you want them to apply to everything, you must define a path with *.
     |
     | allowedOrigins, allowedHeaders and allowedMethods can be set to array('*') 
     | to accept any value, the allowed methods however have to be explicitly listed.
     |
     */
    'defaults' => [
        'allowedCredentials' => true,
        'supportsCredentials' => true,
        'allowedOrigins' => array('http://contourbeta.com'),
        'allowedHeaders' => array('*'),
        'allowedMethods' => array('*'),
        'exposedHeaders' => array('*'),
        'maxAge' => 0,
        'hosts' => array(),
    ],

    'paths' => [
        'api/*' => [
            'allowedOrigins' => array('http://contourbeta.com'),
            'allowedHeaders' => array('*'),
            'allowedMethods' => array('*'),
            'maxAge' => 3600,
        ],
        '*' => [
            'allowedOrigins' => array('http://contourbeta.com'),
            'allowedHeaders' => array('Content-Type'),
            'allowedMethods' => array('POST', 'PUT', 'GET', 'DELETE'),
            'maxAge' => 3600,
            'hosts' => array('api.*'),
        ],
    ],

];
