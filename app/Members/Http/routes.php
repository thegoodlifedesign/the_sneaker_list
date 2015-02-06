<?php
$router->group(['prefix' => 'api/v1/'], function($router)
{
    $router->get('/{slug}', ['uses' => 'Members\Http\Controllers\MemberController@getMember']);
});