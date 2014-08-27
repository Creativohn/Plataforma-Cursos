<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('', function()
{
	return 'inicio'; //View::make('emails.welcome');
});

$admin = Config::get('appglobal.admin.folder');

// Connects Routers
Route::get('login','ConnectController@getlogin');
Route::post('login','ConnectController@postlogin');
Route::get('logout','ConnectController@getlogout');
Route::get('register','ConnectController@getregister');
Route::get('connect/forgot','ConnectController@getforgot');
Route::post('connect/forgot/try', 'ConnectController@postforgot');
Route::post('register/new', 'ConnectController@postnewuser');
Route::get('password/reset/{token}','ConnectController@getresetpassword');
Route::post('password/update','ConnectController@postpasswordupdate');



// Control Routers
Route::get($admin, 'Control_generalController@getindex');
Route::get($admin.'/users', 'Control_usersController@getindex');
Route::get($admin.'/user/{id}/edit', 'Control_usersController@getedit');
Route::post($admin.'/user/{id}/edit', 'Control_usersController@postedit');

// My lobby
Route::get('mylobby', 'Lobby_generalController@getindex');
Route::get('mylobby/profile/edit', 'Lobby_userController@getedit');
Route::post('mylobby/profile/edit', 'Lobby_userController@postedit');


// User Profile
Route::get('{username}', 'Lobby_userController@getuserprofile');