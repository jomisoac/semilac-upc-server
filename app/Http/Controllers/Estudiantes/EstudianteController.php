<?php

namespace App\Http\Controllers\Estudiantes;

use App\Models\Estudiante;
use App\Models\Usuario;
use App\Models\Rol;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;


class EstudianteController extends Controller
{
    public function get($id){
        return $estudiante = Estudiante::find($id);
    }

    function getUsuario($email){
        return Usuario::where('email', $email)->first();
    }

    public function post(Request $request){
        $data = $request->json()->all();
        $usuario = $data['usuario'];
        unset($data['usuario']);
        if($this->get($data['identificacion'])){
            return JsonResponse::create('Ya existe un estudiante con esta identificación');
        }
        else{
            if($this->getUsuario($usuario['email'])){
                return JsonResponse::create('Ya existe un usuario con este email');
            }
            else{
                $usuario = Usuario::nuevo($usuario['email'], $usuario['pass']);
                $data['usuario_id'] = $usuario->id;
                $estudiante = new Estudiante($data);
                if($estudiante->save()){
                    if ($usuario){
                        $usuario->roles()->attach($this->getRol('ESTUDIANTE')->id);
//						Usuario::addRol($usuario->id, $this->getRol('TUTOR')->id);
                        return JsonResponse::create('Exito al registrarse.');
                    }
                    else{
                        $usuario->delete();
                        $estudiante->delete();
                        return JsonResponse::create('Ocurrió un error al guardar los datos.');
                    }
                }
            }

        }
    }

    private function getRol($nombre)
    {
        return Rol::where('nombre', $nombre)->first();
    }
}
