<?php

Route::get('lineas', 'Tutores\LineaInvestigacionController@getAll');
Route::get('lineas/{id}', 'Tutores\LineaInvestigacionController@get');
Route::post('lineas', 'Tutores\LineaInvestigacionController@post');
Route::put('lineas/{id}', 'Tutores\LineaInvestigacionController@put');
Route::delete('lineas/{id}', 'Tutores\LineaInvestigacionController@delete');



