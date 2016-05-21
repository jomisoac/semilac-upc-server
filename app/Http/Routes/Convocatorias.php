<?php

Route::get('convocatorias', 'Convocatorias\ConvocatoriasController@getAll');
Route::post('convocatorias', 'Convocatorias\ConvocatoriasController@post');
Route::post('convocatorias/{id}/acta', 'Convocatorias\ConvocatoriasController@guardarArchivo');