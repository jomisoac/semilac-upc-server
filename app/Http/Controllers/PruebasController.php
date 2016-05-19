<?php

namespace App\Http\Controllers;

use App\Models\Rol;
use App\Models\Usuario;
use Illuminate\Http\Request;

use App\Http\Requests;

class PruebasController extends Controller
{
    public function index(){
        $usuario = $this->createUser('yo', '1234');
        if($usuario){
            $rol_usuario = $this->addRol($usuario);
        }else{
            return $usuario;
        }
        return $rol_usuario;
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
