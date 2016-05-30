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

    public function estudiantesDisponibles(){
        $estudiantes = array();
        $datos = Estudiante::all()->load('proyectos');
        foreach ($datos as $estudiante){
            if(sizeof($estudiante->proyectos) == 0){
                array_push($estudiantes, $estudiante);
            }else{
            }
        }
        return $estudiantes;
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
                return JsonResponse::create(array('mensaje'=>'Ya existe un estudiante con esta identificación.', 'ok' => 'false'));
            } else {
                if ($this->getUsuario($usuario['email'])) {
                    return JsonResponse::create(array('mensaje'=>'Ya existe un usuario con este email.', 'ok' => 'false'));
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
        try{
            $data = $request->json()->all();
            $estudiante = $this->get($id);

            if($estudiante){
//                actualizo los campos del director
                foreach($data as $campo=>$valor){
                    $estudiante->$campo = $valor;
                }
                if($estudiante->save()){
                    return JsonResponse::create('Estudiante actualizado correctamente.');
                }else {
                    return JsonResponse::create('No se pudieron actualizar los datos del estudiante.');
                }
            }else{
                return JsonResponse::create('El estudiante que desea modificar no existe.');
            }

        }catch(Exception $e){
            return JsonResponse::create("Se produjo una excepción.");
        }
    }

    public function createProyecto(Request $request){
        var_dump(\MongoDB\BSON\toJSON($request));
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
