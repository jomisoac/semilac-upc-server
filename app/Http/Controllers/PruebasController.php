<?php

namespace App\Http\Controllers;

use App\Models\Estudiante;
use App\Models\Rol;
use App\Models\Usuario;
use Illuminate\Http\Request;

use App\Http\Requests;

class PruebasController extends Controller
{
    private function verificarMiProyecto($mi_id)
    {
        $datos = Estudiante::where('id', $mi_id)->has('proyectoActivo')->get();
        return sizeof($datos);
    }

    private function verificarProyectoCompanero($companero_id)
    {
        $datos = Estudiante::where('id', $companero_id)->has('proyectoActivo')->get();
        return sizeof($datos);
    }

    public function index()
    {
        if($this->verificarMiProyecto(1) != 0){
            return 'Es mayor que cero mi proyecto';
        }else{
            return $this->verificarProyectoCompanero(3);
        }
    }

    private function addRol($usuario)
    {
        return $usuario->roles()->attach($this->getRol('TUTOR')->id);
    }

    private function createUser($name, $pass)
    {
        return Usuario::nuevo($name, $pass);
    }

    private function getRol($nombre)
    {
        return Rol::where('nombre', $nombre)->first();
    }
}
