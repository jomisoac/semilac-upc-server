<?php

Route::get('/api/directores', 'Director\DirectorController@getAll');
Route::post('/api/directores', 'Director\DirectorController@post');
Route::get('/api/directores/{director_id}', 'Director\DirectorController@get');