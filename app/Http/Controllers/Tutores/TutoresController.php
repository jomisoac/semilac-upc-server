<?php

namespace App\Http\Controllers\Tutores;

use App\Models\Rol;
use App\Models\Usuario;
use App\Models\Tutor;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use Mockery\CountValidator\Exception;
use Symfony\Component\HttpFoundation\JsonResponse;

class TutoresController extends Controller
{
    public function getAll(){
        return Tutor::all();
    }
    public function get($id)
    {
        return $tutor = Tutor::find($id);
    }

    function getUsuario($email)
    {
        return Usuario::where('email', $email)->first();
    }

    public function post(Request $request)
    {
        try {
            $data = $request->json()->all();
            $usuario = $data['usuario'];
            unset($data['usuario']);
            if ($this->get($data['identificacion'])) {
                return JsonResponse::create(array('mensaje'=>'Ya existe un tutor con esta identificación', 'ok' => 'false'));
            } else {
                if ($this->getUsuario($usuario['email'])) {
                    return JsonResponse::create(array('mensaje'=>'Ya existe un usuario con este email', 'ok' => 'false'));
                } else {
                    $usuario = $this->createUser($usuario['email'], $usuario['pass']);
                    $data['usuario_id'] = $usuario->id;
                    $tutor = new Tutor($data);
                    if ($tutor->save()) {
                        if ($usuario) {
                            $this->addRol($usuario);
                            return JsonResponse::create('Registro exitoso, seras redireccionado a la página de inicio sesión.');
                        } else {
                            $tutor->delete();
                            $usuario->delete();
                            return JsonResponse::create(array('mensaje' => 'Ocurrió un error al guardar los datos.', 'ok' => 'false'));
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
        return $usuario->roles()->attach($this->getRol('TUTOR')->id);
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
