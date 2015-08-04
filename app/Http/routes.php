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

Route::get('/', 'WelcomeController@index');

Route::get('home', 'HomeController@index');

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);

Route::get('stokvels/join/{id}', 'StokvelController@join');
Route::get('stokvels/exit/{id}', 'StokvelController@exitStokvel');
Route::get('stokvels/invite/{id}', 'StokvelController@invite');
Route::get('stokvels/users/{id}', 'StokvelController@users');
Route::get('stokvels/generate/{id}', 'StokvelController@generate');

Route::resource('stokvels', 'StokvelController');




Route::get('account', 'UserController@index');
