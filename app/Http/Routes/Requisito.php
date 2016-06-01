<?php

Route::get('requisitos', 'Director\RequisitoController@getAll');
Route::get('requisitos/{id}', 'Director\RequisitoController@get');
Route::post('requisitos', 'Director\RequisitoController@post');
Route::put('requisitos/{id}', 'Director\RequisitoController@put');
Route::delete('requisitos/{id}', 'Director\RequisitoController@delete');


