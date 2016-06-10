<?php

Route::get('semilleros', 'Tutores\SemilleroController@getAll');

//Tutores de cada semillero.
//No usar esta ruta. Usar: tutores/{tutor_id}/semilleros 
Route::get('semilleros/tutores', 'Tutores\SemilleroController@getTutor');

Route::get('semilleros/{id}', 'Tutores\SemilleroController@get');
Route::post('semilleros', 'Tutores\SemilleroController@post');
Route::put('semilleros/{id}', 'Tutores\SemilleroController@put');
Route::delete('semilleros/{id}', 'Tutores\SemilleroController@delete');
