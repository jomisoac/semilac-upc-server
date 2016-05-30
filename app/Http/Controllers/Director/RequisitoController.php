<?php

namespace App\Http\Controllers\Requisito;

use App\Models\Requisito;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use Symfony\Component\HttpFoundation\JsonResponse;

class RequisitoController extends Controller {

    public function getAll() {
        return Requisito::where('activo', '!=', 0)->get();
    }

    public function get($id) {
        return $requisito = Requisito::find($id);
    }

    public function post(Request $request) {
        $data = $request->json()->all();
        $requisito = new Requisito($data);
        if ($requisito->save()) {
            if ($requisito) {
                return JsonResponse::create('Se creó el requisito correctamente.');
            } else {
                $requisito->delete();
                return JsonResponse::create('Ocurrió un error al guardar los datos.');
            }
        }
    }

    public function put(Request $request, $id) {
        try {
            $data = $request->json()->all();
            $requisito = $this->get($id);

            if ($requisito) {
//                actualizar los requisitos
                foreach ($data as $campo => $valor) {
                    $requisito->$campo = $valor;
                }
                if ($requisito->save()) {
                    return JsonResponse::create('Requisito actualizado correctamente');
                } else {
                    return JsonResponse::create('No se pudo actualizar el requisito');
                }
            } else {
                return JsonResponse::create('El requisito que desea modificar no existe');
            }
        } catch (Exception $e) {
            return JsonResponse::create("Se produjo una exepcion");
        }
    }

    //ESTE METODO NO ELMINA, SOLO DESACTIVA
    public function delete($id) {
        $requisito = $this->get($id);
        if ($requisito) {
            $requisito->activo = 0;
            $requisito->save();
            return JsonResponse::create('Requisito eliminado');
        } else {
            return JsonResponse::create('El requisito no existe');
        }
    }

    

}
