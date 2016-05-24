<?php

namespace App\Http\Controllers\Convocatorias;

use App\Models\Convocatoria;
use App\Models\Rol;
use App\Models\Usuario;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use Psy\Util\Json;
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
        //var_dump($request);
        $convocatoria = new Convocatoria();
        $convocatoria->fechainicial = $data['fechainicial'];
        $convocatoria->fechafinal = $data['fechafinal'];
        $convocatoria->asunto = $data['asunto'];
        $convocatoria->usuario_id = $data['usuario_id'];
                if($convocatoria->save()){
                    if ($convocatoria){
                       //$this->guardarArchivo($request, $convocatoria->id);
                        $respuesta = array(
                            'mensaje' => 'Se creó la convocatoria correctamente.',
                            'convocatoria' => $convocatoria
                        );
                        return JsonResponse::create($respuesta);
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

    public function guardarArchivo(Request $request, $id)
    {
            $convocatoria = Convocatoria::find($id);
            if(!$convocatoria){
                return false;
                /*return response()->json(array("message"=> 'No se encontro la convovatoria'), 400);*/
            }
            if ($request->hasFile('acta')) {
                $request->file('acta')->move('archivos/actas/', "acta".$convocatoria->id.'.pdf');
                $acta = 'http://'.$_SERVER['SERVER_NAME'].'/semilac-upc-server/public/archivos/actas/'."acta".$convocatoria->id.'.pdf';
                $convocatoria->acta = $acta;
                $convocatoria->save();
                return $acta;
            }else {
                return false;
                //return response()->json([], 400);
            }
    }

    private function getRol($nombre)
    {
        return Rol::where('nombre', $nombre)->first();
    }
}
