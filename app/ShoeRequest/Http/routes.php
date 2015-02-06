<?php

$router->group(['prefix' => 'api/v1/'], function($router)
{
    $router->get('/shoe-requests', ['uses' => 'ShoeRequest\Http\Controllers\ShoeRequestController@getShoeRequests']);
    $router->post('/shoe-request/set-price', ['uses' => 'ShoeRequest\Http\Controllers\ShoeRequestController@postSetPrice']);
    $router->post('/shoe-request/place-shoe-request', ['uses' => 'ShoeRequest\Http\Controllers\ShoeRequestController@postPlaceShoeRequest']);
    $router->get('/shoe-request/{shoe_request_number}', ['uses' => 'ShoeRequest\Http\Controllers\ShoeRequestController@getShoeRequest']);

});

