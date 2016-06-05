<?php

namespace App\Http\Controllers\Tutores;

use Illuminate\Http\Request;
use App\Models\SolicitudAvalConvocatoria;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Psy\Util\Json;
use Symfony\Component\HttpFoundation\JsonResponse;

class SolicitudAvalConvocatoriaController extends Controller
{
    public function getAll(){
        return SolicitudAvalConvocatoria::all();
    }

    public function get($id){
        return $solicitud = SolicitudAvalConvocatoria::find($id);
    }
    

    public function post(Request $request){
        $data = $request->json()->all();
        //var_dump($request);
        $solicitud = new SolicitudAvalConvocatoria();
        $solicitud->convocatoria_id = $data['convocatoria_id'];
        $solicitud->semillero_id = $data['semillero_id'];

        if($solicitud->save()){
            if ($solicitud){
                $respuesta = array(
                    'mensaje' => 'Envio corréctamente la solicitud.',
                    'solicitud' => $solicitud
                );
                return JsonResponse::create($respuesta);
            }else{
                $solicitud->delete();
                return JsonResponse::create('Ocurrió un error al guardar los datos.');
            }
        }
    }
}



