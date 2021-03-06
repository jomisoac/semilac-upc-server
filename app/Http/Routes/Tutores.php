<?php

Route::get('tutores', 'Tutores\TutoresController@getAll');
Route::post('tutores', 'Tutores\TutoresController@post');
Route::get('tutores/{tutor_id}', 'Tutores\TutoresController@get');

//solicitudes de semillero solicita estudiante
Route::get('semillero_solicita_estudiante', 'Tutores\SemilleroSolicitaEstudianteController@getAll');
Route::post('semillero_solicita_estudiante','Tutores\SemilleroSolicitaEstudianteController@post');
Route::put('semillero_solicita_estudiante/{tutor_id}','Tutores\SemilleroSolicitaEstudianteController@put');

//Las solicitudes que hacen los estudiantes para pertenecer a los semilleros de un tutor
Route::get('tutores/{tutor_id}/invitaciones-de-estudiantes', 'Estudiantes\EstudianteSolicitaSemilleroController@get_by_tutor');
Route::put('/invitaciones-semilleros/{invitacion_id}','Estudiantes\EstudianteSolicitaSemilleroController@put');


//El tutor es el líder de un grupo de investigación y este debe responder las solicitudes...
//...de los semilleros que quieran pertenecer a su grupo.
Route::get('solicitudes-mis-grupos/{tutor_id}','Tutores\SolicitudesMisGruposController@getAll');
Route::put('solicitudes-mis-grupos/{invitacion_id}', 'Tutores\SolicitudesMisGruposController@responder_invitacion');

//Un tutor solamente puede tener un grupo de investigación.
Route::get('tutores/{tutor_id}/grupo', 'Director\GrupoController@get_by_tutor');

//Un tutor tiene varios semilleros
Route::get('tutores/{tutor_id}/semilleros', 'Tutores\SemilleroController@get_by_tutor');

Route::post('solicitud-aval-convocatoria', 'Tutores\SolicitudAvalConvocatoriaController@post');

//Retorna los estudiantes que puede invitar un tutor para pertenecer a su semillero
Route::get('tutores/{tutor_id}/estudiantes-para-invitar', 'Estudiantes\EstudianteController@estudiantes_para_invitar');
Route::get('convocatorias-enviadas/{id}', 'Tutores\SolicitudAvalConvocatoriaController@getAll');