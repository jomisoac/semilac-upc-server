<?php

namespace App\Http\Controllers\Invitaciones_semsillero;

use App\Models\Invitacion;
use Illuminate\Http\Request;
use App\Models\Semillero;
use App\Models\Estudiante;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use Symfony\Component\HttpFoundation\JsonResponse;

class Invitaciones_semillerosController extends Controller
{
    public function getAll()
    {
        return Semillero::where('activo', '!=', 0)->get();
    }

    public function get($id)
    {
        return $semillero = Semillero::find($id);
    }

    public function post(Request $request)
    {
        $data = $request->json()->all();
        $invitacion = new Invitacion($data);
        if ($invitacion->save()) {
            if ($invitacion) {
                return JsonResponse::create('Se envio la invitacion correctamente.');
            } else {
                $invitacion->delete();
                return JsonResponse::create('Ocurrió un error al guardar los datos.');
            }
        }
    }
}
