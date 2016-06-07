<?php

namespace App\Http\Controllers\Tutores;

use Illuminate\Http\Request;
use App\Models\SemilleroSolicitaEstudiante;
use App\Models\Rol;
use App\Models\Usuario;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Psy\Util\Json;
use Symfony\Component\HttpFoundation\JsonResponse;

class SemilleroSolicitaEstudianteController extends Controller
{
    public function getAll()
    {
        return SemilleroSolicitaEstudiante::all();
    }

    public function get_by_estudiante($estudiante_id)
    {
        $solicitudes = SemilleroSolicitaEstudiante::where('estudiante_id', $estudiante_id)
            ->with(['semillero', 'semillero.tutor'])->get();
        return $solicitudes;
    }

    public function get($id)
    {
        return $solicitud = SemilleroSolicitaEstudiante::find($id);
    }

    function getUsuario($email)
    {
        return Usuario::where('email', $email)->first();
    }

    public function post(Request $request)
    {
        $data = $request->json()->all();
        //var_dump($request);
        $solicitud = new SemilleroSolicitaEstudiante();
        $solicitud->estudiante_id = $data['estudiante_id'];
        $solicitud->semillero_id = $data['semillero_id'];

        if ($solicitud->save()) {
            if ($solicitud) {
                //$this->guardarArchivo($request, $convocatoria->id);
                $respuesta = array(
                    'mensaje' => 'Envio corréctamente la solicitud.',
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
                //actualizar los requisitos
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