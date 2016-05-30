<?php

namespace App\Http\Controllers;

use App\Models\Estudiante;
use App\Models\Rol;
use App\Models\Usuario;
use Illuminate\Http\Request;

use App\Http\Requests;

class PruebasController extends Controller
{
    public function index(){
        return $datos = Estudiante::all()->load('proyectos');
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
