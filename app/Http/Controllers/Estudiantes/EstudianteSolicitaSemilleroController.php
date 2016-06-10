<?php

namespace App\Http\Controllers\Estudiantes;

use App\Models\EstudianteSolicitaSemillero;
use App\Models\SemilleroSolicitaEstudiante;
use App\Models\Rol;
use App\Models\Usuario;
use App\Models\Semillero;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use Psy\Util\Json;
use Symfony\Component\HttpFoundation\JsonResponse;

class EstudianteSolicitaSemilleroController extends Controller
{
    public function getAll()
    {
        $solicitudes = EstudianteSolicitaSemillero::all();
        return $solicitudes;
        
    }
    public function get_by_tutor($tutor_id)
    {
        return EstudianteSolicitaSemillero::whereIn('semillero_id', Semillero::select('id')->where('tutor_id',              $tutor_id)->get())->with('estudiante', 'semillero')->get();
    }


    public function get($id)
    {
        return $solicitud = EstudianteSolicitaSemillero::find($id);
    }
    
    function getUsuario($email)
    {
        return Usuario::where('email', $email)->first();
    }
    
    public function post(Request $request)
    {
        $data = $request->json()->all();
        //var_dump($request);
        $solicitud = new EstudianteSolicitaSemillero();
        $solicitud->estudiante_id = $data['estudiante_id'];
        $solicitud->semillero_id = $data['semillero_id'];
        
        if ($solicitud->save()) {
            if ($solicitud) {
                //$this->guardarArchivo($request, $convocatoria->id);
                $respuesta = array(
                'mensaje' => 'Se envió correctamente la solicitud.',
                'solicitud' => $solicitud
                );
                return JsonResponse::create($respuesta);
            } else {
                $solicitud->delete();
                return JsonResponse::create('Ocurrió un error al guardar los datos.');
            }
        }
    }

    public function put(Request $request, $id)
    {
        try {
            $data = $request->json()->all();
            $solicitud = $this->get($id);

            if ($solicitud) {
                //
                foreach ($data as $campo => $valor) {
                    $solicitud->$campo = $valor;
                }
                if ($solicitud->save()) {
                    return JsonResponse::create('Solicitud actualizado correctamente');
                } else {
                    return JsonResponse::create('No se pudo actualizar la solicitud');
                }
            } else {
                return JsonResponse::create('la solicitud que desea modificar no existe');
            }
        } catch (Exception $e) {
            return JsonResponse::create("Se produjo una exepcion");
        }
    }


    private function getRol($nombre)
    {
        return Rol::where('nombre', $nombre)->first();
    }
}
