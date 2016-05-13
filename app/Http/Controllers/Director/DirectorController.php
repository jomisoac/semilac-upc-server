<?php

namespace App\Http\Controllers\Director;

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
        return Director::find($id);
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
                $director = new Director($data);
                if($director->save()){
                    if (Usuario::nuevo($usuario['email'], $usuario['pass'])){
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

    private function getRol($nombre)
    {
        return Rol::where('nombre', $nombre)->first();
    }
}
