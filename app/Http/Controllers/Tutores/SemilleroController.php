<?php

namespace App\Http\Controllers\Tutores;

use App\Models\Semillero;
use App\Models\Tutor;
use App\Models\SolicitudAvalConvocatoria;
use App\Models\SemillerosSolicitanGrupos;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests;

class SemilleroController extends Controller {

    public function getAll() {
        return Semillero::where('activo', '!=', 0)->with('programa', 'grupo', 'tutor')->get();
    }

    public function get_by_tutor($tutor_id) {
        return Semillero::where('activo', '!=', 0)
                        ->where('tutor_id', $tutor_id)
                        ->with('programa', 'grupo')->get();
    }

    public function get_semilleros_no_postulados($convocatoria_id, $tutor_id) {
        $semilleros_postulados = SolicitudAvalConvocatoria::select('semillero_id')
                ->where('tutor_id', $tutor_id)
                ->where('convocatoria_id', $convocatoria_id)
                ->get();
        return Semillero::where('activo', '!=', 0)
                        ->where('tutor_id', $tutor_id)
                        ->whereNotIn('id', $semilleros_postulados)
                        ->get();
    }

    private function get_convocatoria($tutor_id) {
        return SolicitudAvalConvocatoria::where('tutor_id', $tutor_id)->first();
    }

    public function getTutor() {
        $dato = Semillero::where('activo', '!=', 0)->get();
        $dato->load('tutor');
        return $dato;
    }

    public function get($id) {
        return $semillero = Semillero::find($id);
    }

    /*
      public function post(Request $request){
      $data = $request->json()->all();
      if($this->get($data['id'])){
      return JsonResponse::create('Ya existe un semillero con este código');
      }else{
      $semillero = new Semillero($data);
      if($semillero->save()){
      if ($semillero){
      return JsonResponse::create('Se creó el semillero correctamente.');
      }else{
      $semillero->delete();
      return JsonResponse::create('Ocurrió un error al guardar los datos.');
      }
      }
      }
      } */

    public function post(Request $request) {
        $data = $request->json()->all();
        $grupo_id = $data['grupo_id'];
        unset($data['grupo_id']);
        $semillero = new Semillero($data);
        if ($semillero->save()) {
            if ($semillero) {
                $solicitud = new SemillerosSolicitanGrupos();
                $solicitud->semillero_id = $semillero->id;
                $solicitud->grupo_id = $grupo_id;
                $solicitud->save();
                return JsonResponse::create('Se creó el semillero correctamente.');
            } else {
                $semillero->delete();
                return JsonResponse::create('Ocurrió un error al guardar los datos.');
            }
        }
    }

    public function put(Request $request, $id) {
        try {
            $data = $request->json()->all();
            $semillero = $this->get($id);
            if ($semillero) {
                foreach ($data as $campo => $valor) {
                    $semillero->$campo = $valor;
                }
                if ($semillero->save()) {
                    return JsonResponse::create('Semillero actualizado correctamente');
                } else {
                    return JsonResponse::create('No se pudo actualizar el semillero');
                }
            } else {
                return JsonResponse::create('El semillero que desea modificar no existe');
            }
        } catch (Exception $e) {
            return JsonResponse::create("Se produjo una exepcion");
        }
    }

    //ESTE METODO NO ELMINA, SOLO DESACTIVA
    public function delete($id) {
        $semillero = $this->get($id);
        if ($semillero) {
            $semillero->activo = 0;
            $semillero->save();
            return JsonResponse::create('Semillero eliminado');
        } else {
            return JsonResponse::create('El semillero no existe');
        }
    }

}
