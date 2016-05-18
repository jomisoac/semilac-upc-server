<?php
/**
 * Created by Jose Soto.
 * Date: 18/05/2016
 * Time: 2:48 PM
 */

Route::get('/perfil/usuario/{usuario_id}', 'Auth\PerfilController@getDatosPerfil');