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
        $data = $request->json()->all();
        $usuario = $data['usuario'];
        unset($data['usuario']);
        if($this->get($data['identificacion'])){
            return JsonResponse::create('Ya existe un director con esta identificación');
        }else{
            if($this->getUsuario($usuario['email'])){
                return JsonResponse::create('Ya existe un usuario con este email');
            }else{
                $usuario = Usuario::nuevo($usuario['email'], $usuario['pass']);
                $data['usuario_id'] = $usuario->id;
                $director = new Director($data);
                if($director->save()){
                    if ($usuario){
                        Usuario::addRol($usuario->id, $this->getRol('DIRECTOR')->id);
                        return JsonResponse::create('Se creo el director corectamente');
                    }else{
                        $usuario->delete();
                        $director->delete();
                        return JsonResponse::create('Ocurrio un error al guardar los datos');
                    }
                }
            }
        }
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
                    return JsonResponse::create('Director actualizado correctamente');
                }else {
                    return JsonResponse::create('No se pudo actualizar los datos del director');
                }
            }else{
                return JsonResponse::create('El director que desea modificar no existe');
            }

        }catch(Exception $e){
            return JsonResponse::create("Se produjo una exepcion");
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
            return JsonResponse::create('Director inhabilitado');
        }else{
            return JsonResponse::create('El conductor no existe');
        }
    }

    private function getRol($nombre)
    {
        return Rol::where('nombre', $nombre)->first();
    }
}
