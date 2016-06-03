<?php

Route::get('tutores', 'Tutores\TutoresController@getAll');
Route::post('tutores', 'Tutores\TutoresController@post');
Route::get('tutores/{tutor_id}', 'Tutores\TutoresController@get');
//Route::put('tutores/{tutor_id}', 'Tutores\TutoresController@put');
//Route::delete('requisitos/{tutor_id}', 'Tutores\TutoresController@delete');

//solicitudes de semillero solicita estudiante
Route::get('semillero_solicita_estudiante', 'Tutores\SemilleroSolicitaEstudianteController@estudiantesDisponibles');
Route::post('semillero_solicita_estudiante','Tutores\SemilleroSolicitaEstudianteController@post');

