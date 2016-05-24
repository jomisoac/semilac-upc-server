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
        try {
            $data = $request->json()->all();
            $usuario = $data['usuario'];
            unset($data['usuario']);
            if ($this->get($data['identificacion'])) {
                return JsonResponse::create(array('mensaje'=>'Ya existe un estudiante con esta identificación', 'ok' => 'false'));
            } else {
                if ($this->getUsuario($usuario['email'])) {
                    return JsonResponse::create(array('mensaje'=>'Ya existe un usuario con este email', 'ok' => 'false'));
                } else {
                    $usuario = $this->createUser($usuario['email'], $usuario['pass']);
                    $data['usuario_id'] = $usuario->id;
                    $estudiante = new Estudiante($data);
                    if ($estudiante->save()) {
                        if ($usuario) {
                            $this->addRol($usuario);
                            return JsonResponse::create('Se registró correctamente, seras redireccionado a la página de inicio sesión.');
                        } else {
                            $estudiante->delete();
                            $usuario->delete();
                            return JsonResponse::create(array('mensaje' => 'Ocurrió un error al guardar los datos, intentalo deneuvo.', 'ok' => 'false'));
                        }
                    }
                }
            }
        } catch (Exception $e) {
            return JsonResponse::create('Se produjo una exepción');
        }
    }

    private function addRol($usuario)
    {
        return $usuario->roles()->attach($this->getRol('ESTUDIANTE')->id);
    }

    private function createUser($name, $pass)
    {
        return Usuario::nuevo($name, $pass);
    }

    private function getRol($nombre)
    {
        return Rol::where('nombre', $nombre)->first();
    }
}
