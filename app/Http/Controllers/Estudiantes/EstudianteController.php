<?php

namespace App\Http\Controllers\Estudiantes;

use App\Models\Estudiante;
use App\Models\Proyectos;
use App\Models\Usuario;
use App\Models\Rol;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;


class EstudianteController extends Controller
{
    public function get($id)
    {
        return $estudiante = Estudiante::find($id);
    }

    public function estudiantesDisponibles($mi_id = null)
    {
        $estudiantes = array();
        if($mi_id){
            $datos = Estudiante::where('id', '!=', $mi_id)->get();
            $datos->load('proyectos', 'programa');
            foreach ($datos as $estudiante) {
                if (sizeof($estudiante->proyectos) == 0) {
                    array_push($estudiantes, $estudiante);
                } else {
                }
            }
        }else{
            $datos = Estudiante::all();
            $datos->load('proyectos', 'programa');
            foreach ($datos as $estudiante) {
                if (sizeof($estudiante->proyectos) == 0) {
                    array_push($estudiantes, $estudiante);
                } else {
                }
            }
        }

        return $estudiantes;
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
                return JsonResponse::create(array('mensaje' => 'Ya existe un estudiante con esta identificación.', 'ok' => 'false'));
            } else {
                if ($this->getUsuario($usuario['email'])) {
                    return JsonResponse::create(array('mensaje' => 'Ya existe un usuario con este email.', 'ok' => 'false'));
                } else {
                    $usuario = $this->createUser($usuario['email'], $usuario['pass']);
                    $data['usuario_id'] = $usuario->id;
                    $estudiante = new Estudiante($data);
                    if ($estudiante->save()) {
                        if ($usuario) {
                            $this->addRol($usuario);
                            return JsonResponse::create('Se registró correctamente. Serás redireccionado a la página de inicio de sesión.');
                        } else {
                            $estudiante->delete();
                            $usuario->delete();
                            return JsonResponse::create(array('mensaje' => 'Ocurrió un error al guardar los datos. Inténtalo de nuevo.', 'ok' => 'false'));
                        }
                    }
                }
            }
        } catch (Exception $e) {
            return JsonResponse::create('Se produjo una excepción.');
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $data = $request->json()->all();
            $estudiante = $this->get($id);

            if ($estudiante) {
//                actualizo los campos del director
                foreach ($data as $campo => $valor) {
                    $estudiante->$campo = $valor;
                }
                if ($estudiante->save()) {
                    return JsonResponse::create('Estudiante actualizado correctamente.');
                } else {
                    return JsonResponse::create('No se pudieron actualizar los datos del estudiante.');
                }
            } else {
                return JsonResponse::create('El estudiante que desea modificar no existe.');
            }

        } catch (Exception $e) {
            return JsonResponse::create("Se produjo una excepción.");
        }
    }

    private function verificarProyecto($nombre)
    {
        return Proyectos::where('nombre', $nombre)->first();
    }

    private function verificarMiProyecto($mi_id)
    {
        $datos = Estudiante::where('id', $mi_id)->has('proyectoActivo')->get();
        return sizeof($datos);
    }

    private function verificarProyectoCompanero($companero_id)
    {
        $datos = Estudiante::where('id', $companero_id)->has('proyectoActivo')->get();
        return sizeof($datos);
    }

    public function createProyecto(Request $request)
    {
        $data = $request->all();
        $estudiates = $data['estudiates'];
        unset($data['estudiantes']);
        $vproyecto = $this->verificarProyecto($data['nombre']);
        if ($vproyecto) {
            return JsonResponse::create(array('mensaje' => 'Ya existe un proyecto registrado con este nombre.', 'ok' => 'false'));
        } else {
            foreach ($estudiates as $estudiante){
                if($this->verificarMiProyecto($estudiante) != 0){
                    return JsonResponse::create(array('mensaje' => 'Actualmente tu o tu compa&ntilde;ero ya se encuentran asociados a un proyecto, finalizalo para que puedas seguir inscribiendo mas.', 'ok' => 'false'));
                }else{
                    $proyecto = new Proyectos($data);
                    if ($proyecto->save()) {
                        $proyecto->estudiantes()->attach($estudiates);
                        return JsonResponse::create('Se registró correctamente el proyecto.');
                    } else {
                        $proyecto->delete();
                        return JsonResponse::create(array('mensaje' => 'Ocurrió un error al guardar los datos. Inténtalo de nuevo.', 'ok' => 'false'));
                    }
                }
            }
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
