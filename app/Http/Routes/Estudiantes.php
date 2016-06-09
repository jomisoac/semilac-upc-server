<?php
/**
 * Created by Jose Soto.
 * Date: 16/05/2016
 * Time: 2:35 PM
 */

//Route::get('/estudiantes', 'Estudiantes\EstudianteController@getAll');
Route::get('estudiantes/solicitudes-semilleros','Estudiantes\EstudianteSolicitaSemilleroController@getAll');

Route::get('/estudiantes/disponibles/{mi_id}', 'Estudiantes\EstudianteController@estudiantesDisponibles');
Route::get('/estudiantes/disponibles', 'Estudiantes\EstudianteController@estudiantesDisponibles');
Route::get('/estudiantes/{estudiante_id}', 'EstudianteController@get');

Route::post('/estudiantes', 'Estudiantes\EstudianteController@post');
Route::put('/estudiantes/{estudiante_id}', 'Estudiantes\EstudiantesController@update');
Route::delete('/estudiantes/{estudiante_id}', 'Estudiantes\EstudiantesController@delete');

Route::post('/estudiantes/nuevo_proyecto', 'Estudiantes\EstudianteController@createProyecto');

//solicitudes

Route::post('solicitudes-semilleros','Estudiantes\EstudianteSolicitaSemilleroController@post');

//invitaciones
Route::get('estudiantes/{estudiante_id}/invitaciones-de-semilleros', 'Tutores\SemilleroSolicitaEstudianteController@get_by_estudiante');