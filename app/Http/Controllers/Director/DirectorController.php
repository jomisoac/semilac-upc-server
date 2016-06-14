<?php

namespace App\Http\Controllers\Director;

use App\Models\Rol;
use App\Models\Usuario;
use App\Models\Director;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use Symfony\Component\HttpFoundation\JsonResponse;
use DB;

class DirectorController extends Controller
{
    public function deshabilitar_otros_directores($director_nuevo)
    {
        $result = false;
        //Solamente puede haber un director activo, y solamente un usuario con un rol director.
        DB::transaction(function () use($director_nuevo, &$result) {
            $directores_antiguos = Director::select('id')->where('id', '!=', $director_nuevo->id)->get();
            Director::whereIn('id', $directores_antiguos)->update(['activo' => false]);
            $usuarios_directores_antiguos = Director::select('usuario_id')->where('id', '!=', $director_nuevo->id)->get();
            DB::table('rol_usuario')->whereIn('usuario_id', $usuarios_directores_antiguos)->delete();
            $result = true;
        });
        return $result;
    }
    
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
        $respuesta = [];
        DB::transaction(function () use($request, &$respuesta) {
            try {
                $data = $request->json()->all();
                $usuario = $data['usuario'];
                unset($data['usuario']);
                if ($this->get($data['identificacion'])) {
                    $respuesta = array_merge($respuesta, array('mensaje'=>'Ya existe un director con esta identificación.', 'ok' => 'false'));
                } else {
                    if ($this->getUsuario($usuario['email'])) {
                        $respuesta = array_merge($respuesta, array('mensaje'=>'Ya existe un usuario con este email', 'ok' => 'false'));
                    } else {
                        $usuario = $this->createUser($usuario['email'], $usuario['pass']);
                        $data['usuario_id'] = $usuario->id;
                        $director = new Director($data);
                        if ($director->save()) {
                            if ($usuario) {
                                $this->addRol($usuario);
                                $directores_deshabilitados = $this->deshabilitar_otros_directores($director);
                                if (!$directores_deshabilitados) {
                                    $respuesta['mensaje'] = "No se pudo deshabilitar a los directores.";
                                    $director->delete();
                                    $usuario->delete();
                                } else {
                                    $respuesta['mensaje'] = "Se creó el director correctamente.";
                                }
                            } else {
                                $director->delete();
                                $usuario->delete();
                                $respuesta = array_merge($respuesta, array('mensaje' => 'Ocurrió un error al guardar los datos, inténtalo de nuevo.', 'ok' => 'false'));
                            }
                        }
                    }
                }
            } catch (Exception $e) {
                $respuesta['mensaje'] = "Se produjo una excepción.";
            }
        });
        return JsonResponse::create($respuesta);
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