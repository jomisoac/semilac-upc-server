<?php

Route::get('semilleros', 'Semillero\SemilleroController@getAll');
Route::get('semilleros/{id}', 'Semillero\SemilleroController@get');
Route::post('semilleros', 'Semillero\SemilleroController@post');
Route::put('semilleros/{id}', 'Semillero\SemilleroController@put');
Route::delete('semilleros/{id}', 'Semillero\SemilleroController@delete');

