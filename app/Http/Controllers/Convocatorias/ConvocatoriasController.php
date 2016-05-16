<?php

namespace App\Http\Controllers\Convocatorias;

use App\Models\Convocatoria;
use App\Models\Rol;
use App\Models\Usuario;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use Symfony\Component\HttpFoundation\JsonResponse;

class ConvocatoriasController extends Controller
{
    public function getAll(){
        return Convocatoria::all();
    }

    public function get($id){
        return $director = Convocatoria::find($id);
    }

    function getUsuario($email){
        return Usuario::where('email', $email)->first();
    }

    public function post(Request $request){
        $data = $request->json()->all();
        $convocatoria = new Convocatoria($data);
                if($convocatoria->save()){
                    if ($convocatoria){
                        return JsonResponse::create('Se creó la convocatoria correctamente.');
                    }else{
                        $convocatoria->delete();
                        return JsonResponse::create('Ocurrió un error al guardar los datos.');
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
