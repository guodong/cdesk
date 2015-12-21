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

Route::get('/', 'IndexController@index');

Route::get('home', 'HomeController@index');
Route::get('vm', 'VmController@index');
Route::get('server', 'ServerController@index');
Route::get('user', 'UserController@index');
Route::get('image', 'ImageController@index');
Route::get('tpl', 'TplController@index');

Route::resource('api/server', 'Api\ServerController');
Route::resource('api/vm', 'Api\VmController');

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);
