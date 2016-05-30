<?php

Route::get('convocatorias', 'Director\ConvocatoriasController@getAll');
Route::post('convocatorias', 'Director\ConvocatoriasController@post');
Route::post('convocatorias/{id}/acta', 'Director\ConvocatoriasController@guardarArchivo');