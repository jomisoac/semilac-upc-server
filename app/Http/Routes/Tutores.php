<?php

Route::get('tutores', 'Tutores\TutoresController@getAll');
Route::post('tutores', 'Tutores\TutoresController@post');
Route::get('tutores/{tutor_id}', 'Tutores\TutoresController@get');

//solicitudes de semillero solicita estudiante
Route::get('semillero_solicita_estudiante', 'Tutores\SemilleroSolicitaEstudianteController@getAll');
Route::post('semillero_solicita_estudiante','Tutores\SemilleroSolicitaEstudianteController@post');
Route::put('semillero_solicita_estudiante/{tutor_id}','Tutores\SemilleroSolicitaEstudianteController@put');

//El tutor es el líder de un grupo de investigación y este debe responder las solicitudes...
//...de los semilleros que quieran pertenecer a su grupo.
Route::get('solicitudes-mis-grupos/{tutor_id}','Tutores\SolicitudesMisGruposController@getAll');
Route::put('solicitudes-mis-grupos/{invitacion_id}', 'Tutores\SolicitudesMisGruposController@responder_invitacion');

//Un tutor solamente puede tener un grupo de investigación.
Route::get('tutores/{tutor_id}/grupo', 'Director\GrupoController@get_by_tutor');

//Un tutor tiene varios semilleros
Route::get('tutores/{tutor_id}/semilleros', 'Tutores\SemilleroController@get_by_tutor');
