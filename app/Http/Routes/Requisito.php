<?php

Route::get('requisitos', 'Requisito\RequisitoController@getAll');
Route::get('requisitos/{id}', 'Requisito\RequisitoController@get');
Route::post('requisitos', 'Requisito\RequisitoController@post');
Route::put('requisitos/{id}', 'Requisito\RequisitoController@put');
Route::delete('requisitos/{id}', 'Requisito\RequisitoController@delete');


