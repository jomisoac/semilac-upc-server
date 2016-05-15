<?php

namespace App\Http\Controllers\Grupo;

use App\Models\Rol;
use App\Models\Usuario;
use App\Models\Grupo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use Symfony\Component\HttpFoundation\JsonResponse;

class GrupoController extends Controller
{
    public function getAll(){
        return Grupo::all();
    }

    public function get($codigo){
        return Grupo::where('codigo', $codigo)->first();
    }

    function getUsuario($email){
        return Usuario::where('email', $email)->first();
    }

    public function post(Request $request){
        $data = $request->json()->all();
        if($this->get($data['codigo'])){
            return JsonResponse::create('Ya existe un grupo con este código');
        }else{
                $grupo = new Grupo($data);
                //$data['usuario_id'] = $grupo->id;
                //$director = new Director($data);
                if($grupo->save()){
                    if ($grupo){
                        //Usuario::addRol($grupo->id, $this->getRol('DIRECTOR')->id);
                        return JsonResponse::create('Se creó el grupo correctamente.');
                    }else{
                        $grupo->delete();
                        //$director->delete();
                        return JsonResponse::create('Ocurrió un error al guardar los datos.');
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
