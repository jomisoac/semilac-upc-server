<?php

Route::get('convocatorias', 'Director\ConvocatoriasController@getAll');
Route::post('convocatorias', 'Director\ConvocatoriasController@post');
Route::post('convocatorias/{id}/acta', 'Director\ConvocatoriasController@guardarArchivo');
Route::get('convocatorias/convocatoria-abierta', 'Director\ConvocatoriasController@get_convocatoria_abierta');

//Semilleros de un tutor que no se han postulados para una convocatoria
Route::get('convocatorias/{convocatoria_id}/tutores/{tutor_id}/semilleros-no-postulados', 'Tutores\SemilleroController@get_semilleros_no_postulados');


