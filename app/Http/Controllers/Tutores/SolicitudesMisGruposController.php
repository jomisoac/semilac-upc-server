<?php

namespace App\Http\Controllers\Tutores;

use Illuminate\Http\Request;
use App\Models\Rol;
use App\Models\Usuario;
use App\Models\SemillerosSolicitanGrupos;
use App\Models\Grupo;
use App\Models\Tutor;
use App\Models\Semillero;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Psy\Util\Json;
use Symfony\Component\HttpFoundation\JsonResponse;

class SolicitudesMisGruposController extends Controller
{
    public function getAll($tutor_id){
        return SemillerosSolicitanGrupos::whereIn('grupo_id', Grupo::select('id')->where('tutor_id', $tutor_id)->get())
        ->where('respuesta', 'en espera')
        ->with('semillero', 'grupo')
        ->get();
        //return Grupo::where('tutor_id', $tutor_id)->with(['solicitudes_de_semilleros', 'solicitudes_de_semilleros.semillero'])->get();
    }
    
    public function get($id){
        //return $solicitud = SemillerosSolicitanGrupos::find($id);
    }
    
    function getUsuario($email){
        // return Usuario::where('email', $email)->first();
    }
    
    public function responder_invitacion(Request $request, $id) {
        try {
            $data = $request->json()->all();
            $solicitud = SemillerosSolicitanGrupos::find($id);
            if ($solicitud) {
                $solicitud->fill($data);
                if ($solicitud->save()) {
                    //Si respondió la solicitud como 'aceptada', debe actualizar el grupo_id del semillero.
                    if ($solicitud->respuesta == 'aceptada') {
                        $semillero = Semillero::find($solicitud->semillero_id);
                        $semillero->grupo_id = $solicitud->grupo_id;
                        if ($semillero->save()) {
                            //Si pudo actualizar el grupo_id del semillero.
                            return JsonResponse::create('La solicitud ha sido respondida.');
                        } else {
                            //Si no se pudo actualizar el grupo_id del semillero...
                            //...es necesario deshacer la operación: dejar la solicitud 'en espera'.
                            $solicitud->respuesta = 'en espera';
                            $solicitud->save();
                            return JsonResponse::create('No se pudo responder la solicitud.');
                        }
                    }
                } else {
                    return JsonResponse::create('No se pudo responder la solicitud.');
                }
            } else {
                return JsonResponse::create('La solicitud que desea responder no existe.');
            }
        } catch (Exception $e) {
            return JsonResponse::create("¡Error!");
        }
    }
}