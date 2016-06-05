<?php

Route::get('semilleros', 'Tutores\SemilleroController@getAll');
//tutores de cada semillero
Route::get('semilleros/tutores', 'Tutores\SemilleroController@getTutor');
Route::get('semilleros/{id}', 'Tutores\SemilleroController@get');
Route::post('semilleros', 'Tutores\SemilleroController@post');
Route::put('semilleros/{id}', 'Tutores\SemilleroController@put');
Route::delete('semilleros/{id}', 'Tutores\SemilleroController@delete');




