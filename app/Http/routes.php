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
include 'Routes/Director.php';
Route::group(['middleware' => 'cors'], function ()
{
    Route::group(['prefix' => 'api'], function()
    {
        Route::post('login', 'Auth\LoginController@autenticarUsuario');
        Route::get('new_token', 'Auth\LoginController@refreshToken');

    });
});
