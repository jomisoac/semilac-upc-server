<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;

use JWTAuth;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class UsuariosController extends Controller
{
    public function updatePassword(Request $request, $id)
    {
        $contrasena_actual = $request->get('actual');
        $contrasena_nueva = $request->get('nueva');
        $user = Usuario::find($id);
        if(password_verify($contrasena_actual , $user->password)) {
            $user->password = password_hash($contrasena_nueva, PASSWORD_DEFAULT);
            $user->estado = 1;
            $user->save();
        } else {
            return response()->json(['mensajeError' => 'Contraseña incorrecta'], 401);
        }
        return response()->json(['mensaje' => 'Contraseña actualizada'], 200);
    }

    public function create(Request $request)
    {
        try {
            $user = Usuario::nuevo($request->get('name'), $request->get('pass'), $request->get('id_rol'));
        } catch (\Exception $e) {
            return response()->json(['error' => 'User already exists.'], 409);
        }

        $token = JWTAuth::fromUser($user);

        return response()->json(compact('token'));
    }

    private function getRol($nombre)
    {
        return Rol::where('nombre', $nombre)->first();
    }

}
