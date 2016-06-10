<?php

namespace App\Http\Controllers\Tutores;
use App\Models\Linea;
use App\Models\Grupo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use Mockery\CountValidator\Exception;
use Symfony\Component\HttpFoundation\JsonResponse;

class LineaInvestigacionController extends Controller
{

    public function getAll()
    {
        return Linea::where('activo', '!=', 0)->get();
    }

    public function get($id)
    {
        return $linea = Linea::find($id);
    }

    public function post(Request $request)
    {
        $data = $request->json()->all();
        $linea = new Linea($data);
        if ($linea->save()) {
            if ($linea) {
                return JsonResponse::create('Se creó la línea correctamente.');
            } else {
                $linea->delete();
                return JsonResponse::create('Ocurrió un error al guardar los datos.');
            }
        }
    }
}

