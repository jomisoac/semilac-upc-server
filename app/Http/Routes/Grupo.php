<?php
Route::get('grupo', 'Grupo\GrupoController@getAll');
Route::post('grupo', 'Grupo\GrupoController@post');
Route::get('grupo/{grupo_id}', 'Grupo\GrupoController@get');
