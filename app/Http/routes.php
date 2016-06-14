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

Route::get('/api/prueba', 'PruebasController@index');
Route::group(['middleware' => 'cors'], function () {
    Route::group(['prefix' => 'api'], function () {
        Route::post('/login', 'Auth\LoginController@autenticarUsuario');
        Route::get('/new_token', 'Auth\LoginController@refreshToken');
        Route::get('/programas', 'Programas\ProgramaController@getAll');

        //Route::group(['middleware' => 'jwt.auth'], function () {
            // Agrega automaticamente los archivos php dentro de la carpeta Routes.
            $ruta = $_SERVER["DOCUMENT_ROOT"] . "/semilac-upc-server/" . "app/Http/Routes";
            foreach (glob("$ruta/*.php") as $filename) {
                include_once $filename;
            }
        //});
    });

});
