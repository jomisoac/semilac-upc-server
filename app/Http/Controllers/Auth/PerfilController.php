<?php

namespace App\Http\Controllers\Auth;

use App\Models\Director;
use App\Models\Estudiante;
use App\Models\Tutor;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;

class PerfilController extends Controller
{
    public function getDatosPerfil($id){
        if($estudiante = Estudiante::where('usuario_id', $id)->first()){
            $estudiante->load('programa');
            return $estudiante;
        }elseif ($tutor = Tutor::where('usuario_id', $id)->first()){
            return $tutor;
        }elseif ($director = Director::where('usuario_id', $id)->first()){
            return $director;
        }else{
            return JsonResponse::create('El usuario no tiene un perfil asignado');
        }
    }
}
