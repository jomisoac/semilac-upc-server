<?php

namespace App\Http\Controllers\Tutores;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Psy\Util\Json;
use Illuminate\Http\JsonResponse;
use App\Models\SolicitudAvalConvocatoria;

class SolicitudAvalConvocatoriaController extends Controller
{
    public function getAll(){
        //return SolicitudAvalConvocatoria::all();
        return SolicitudAvalConvocatoria::all()->with('tutor','semillero')->get();
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
        $solicitud->tutor_id = $data['tutor_id'];

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



