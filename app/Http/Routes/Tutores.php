<?php

Route::get('tutores', 'Tutores\TutoresController@getAll');
Route::post('tutores', 'Tutores\TutoresController@post');
Route::get('tutores/{tutor_id}', 'Tutores\TutoresController@get');
//Route::put('tutores/{tutor_id}', 'Tutores\TutoresController@put');
//Route::delete('requisitos/{tutor_id}', 'Tutores\TutoresController@delete');

//solicitudes de semillero solicita estudiante
Route::get('semillero_solicita_estudiante', 'Tutores\SemilleroSolicitaEstudianteController@getAll');
Route::post('semillero_solicita_estudiante','Tutores\SemilleroSolicitaEstudianteController@post');
Route::put('semillero_solicita_estudiante/{tutor_id}','Tutores\SemilleroSolicitaEstudianteController@put');

//solicitudes a mis grupos
Route::get('solicitudes-mis-grupos/{tutor_id}','Tutores\SolicitudesMisGruposController@getAll');
Route::put('solicitudes-mis-grupos/{invitacion_id}', 'Tutores\SolicitudesMisGruposController@responder_invitacion');

//Un tutor solamente puede tener un grupo de investigación.
Route::get('tutores/{tutor_id}/grupo', 'Director\GrupoController@get_by_tutor');

//Un tutor tiene varios semilleros
Route::get('tutores/{tutor_id}/semilleros', 'Director\GrupoController@get_by_tutor');