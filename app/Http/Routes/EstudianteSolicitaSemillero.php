<?php
Route::get('grupo', 'Director\GrupoController@getAll');
Route::post('grupo', 'Director\GrupoController@post');
Route::get('grupo/{grupo_id}', 'Director\GrupoController@get');
