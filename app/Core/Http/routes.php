<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

$router->get('/', 'Core\Http\Controllers\WelcomeController@index');

$router->get('home', 'Core\Http\Controllers\HomeController@index');

$router->controllers([
	'auth' => 'Core\Http\Controllers\Auth\AuthController',
	'password' => 'Core\Http\Controllers\Auth\PasswordController',
]);
