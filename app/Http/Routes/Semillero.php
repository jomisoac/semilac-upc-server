<?php

Route::get('semilleros', 'Director\SemilleroController@getAll');
//tutores de cada semillero
Route::get('semilleros/tutores', 'Director\SemilleroController@getTutor');
Route::get('semilleros/{id}', 'Director\SemilleroController@get');
Route::post('semilleros', 'Director\SemilleroController@post');
Route::put('semilleros/{id}', 'Director\SemilleroController@put');
Route::delete('semilleros/{id}', 'Director\SemilleroController@delete');




