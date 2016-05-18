<?php

namespace App\Http\Controllers\Tutores;

use App\Models\Rol;
use App\Models\Usuario;
use App\Models\Tutor;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use Symfony\Component\HttpFoundation\JsonResponse;

class TutoresController extends Controller
{
	public function get($id){
        return $tutor = Tutor::find($id);
    }
	
	function getUsuario($email){
        return Usuario::where('email', $email)->first();
    }
	
	public function post(Request $request){
		$data = $request->json()->all();
		$usuario = $data['usuario'];
		unset($data['usuario']);
		if($this->get($data['identificacion'])){
			return JsonResponse::create('Ya existe un tutor con esta identificación');
		}
		else{
			if($this->getUsuario($usuario['email'])){
				return JsonResponse::create('Ya existe un usuario con este email');
			}
			else{
				$usuario = Usuario::nuevo($usuario['email'], $usuario['pass']);
				$data['usuario_id'] = $usuario->id;
				$tutor = new Tutor($data);
				if($tutor->save()){
					if ($usuario){
						if($usuario->roles()->attach($this->getRol('TUTOR')->id)){
							return JsonResponse::create('Se creó el tutor correctamente.');	
						}else{
							$usuario->delete();
							return JsonResponse::create('Ocurrio un error al asignarte el rol, intentalo denuevo.');
						}
//						Usuario::addRol($usuario->id, $this->getRol('TUTOR')->id);
						
					}
					else{
						$usuario->delete();
						$tutor->delete();
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
