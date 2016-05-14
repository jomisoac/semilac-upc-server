<?php

Route::get('director', 'Director\DirectorController@getAll');
Route::post('director', 'Director\DirectorController@post');
Route::get('director/{director_id}', 'Director\DirectorController@get');