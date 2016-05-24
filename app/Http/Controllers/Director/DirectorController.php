<?php

namespace App\Http\Controllers\Director;

use App\Models\Rol;
use App\Models\Usuario;
use App\Models\Director;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use Symfony\Component\HttpFoundation\JsonResponse;

class DirectorController extends Controller
{
    public function getAll(){
        return Director::all();
    }
    
    public function get($id){
        return $director = Director::find($id);
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
                return JsonResponse::create(array('mensaje'=>'Ya existe un director con esta identificación.', 'ok' => 'false'));
            } else {
                if ($this->getUsuario($usuario['email'])) {
                    return JsonResponse::create(array('mensaje'=>'Ya existe un usuario con este email', 'ok' => 'false'));
                } else {
                    $usuario = $this->createUser($usuario['email'], $usuario['pass']);
                    $data['usuario_id'] = $usuario->id;
                    $director = new Director($data);
                    if ($director->save()) {
                        if ($usuario) {
                            $this->addRol($usuario);
                            return JsonResponse::create('Se creó el director correctamente.');
                        } else {
                            $director->delete();
                            $usuario->delete();
                            return JsonResponse::create(array('mensaje' => 'Ocurrió un error al guardar los datos, inténtalo de nuevo.', 'ok' => 'false'));
                        }
                    }
                }
            }
        } catch (Exception $e) {
            return JsonResponse::create('Se produjo una excepción.');
        }
    }

    private function addRol($usuario)
    {
        return $usuario->roles()->attach($this->getRol('DIRECTOR')->id);
    }

    private function createUser($name, $pass)
    {
        return Usuario::nuevo($name, $pass);
    }

    public function put(Request $request, $id)
    {
        try{
            $data = $request->json()->all();
            $director = $this->get($id);

            if($director){
//                actualizo los campos del director
                foreach($data as $campo=>$valor){
                    $director->$campo = $valor;
                }
                if($director->save()){
                    return JsonResponse::create('Director actualizado correctamente.');
                }else {
                    return JsonResponse::create('No se pudieron actualizar los datos del director.');
                }
            }else{
                return JsonResponse::create('El director que desea modificar no existe.');
            }

        }catch(Exception $e){
            return JsonResponse::create("Se produjo una excepción.");
        }
    }

    //ESTE METODO NO ELMINA, SOLO DESACTIVA
    public function delete($id)
    {
        $director = $this->get($id);
        if($director){
            $usuario = $director->usuario;
            $usuario->estado = -1;
            $director->activo = 0;
            $director->save();
            $usuario->save();
            return JsonResponse::create('Director inhabilitado.');
        }else{
            return JsonResponse::create('El director no existe.');
        }
    }

    private function getRol($nombre)
    {
        return Rol::where('nombre', $nombre)->first();
    }
}
