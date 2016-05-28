<?php
Route::get('solicitud-semilleros', 'Estudiante_solicita_semillero\EstudianteSolicitaSemilleroController@getAll');
Route::post('solicitud-semilleros','Estudiante_solicita_semillero\EstudianteSolicitaSemilleroController@post');

