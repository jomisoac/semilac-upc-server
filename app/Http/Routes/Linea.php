<?php

Route::get('lineas', 'Tutores\Linea_investigacionController@getAll');
Route::get('lineas/{id}', 'Tutores\Linea_investigacionController@get');
Route::post('lineas', 'Tutores\Linea_investigacionController@post');
Route::put('lineas/{id}', 'Tutores\Linea_investigacionController@put');
Route::delete('lineas/{id}', 'Tutores\Linea_investigacionController@delete');



