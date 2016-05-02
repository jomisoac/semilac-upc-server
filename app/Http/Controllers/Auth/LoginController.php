<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;

use App\Models\Usuario;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;

use App\Http\Requests;
use App\Http\Controllers\Controller;


class LoginController extends Controller
{
    public function autenticarUsuario(Request $request)
    {
        // credenciales para loguear al usuario
        $credentials['email'] = $request->get('name');
        $credentials['password'] = $request->get('pass');

        try {
            $user = Usuario::where('email' ,$credentials['email'])->first();
            if($user && password_verify($credentials['password'] , $user->password)) {
                $token = JWTAuth::fromUser($user, $this->getData($user));
            } else {
                return response()->json(['mensajeError' => 'Usuario o contraseña incorrectos, intentelo denuevo'], 401);
            }
        } catch (JWTException $e) {
            // si no se puede crear el token
            return response()->json(['error' => 'No se pudo crear el token'], 500);
        }

        // todo bien devuelve el token
        return response()->json(compact('token'));
    }

    public function refreshToken()
    {
        $token = JWTAuth::getToken();
        if(!$token){
            return response()->json(['Token no proporcionado'], 401);
        }
        try{
            $token = JWTAuth::refresh($token);
        }catch(TokenInvalidException $e){
            return response()->json(['messageError' => $e->getMessage()], 403);
        }
        return response()->json(['token'=>$token]);
    }

    private function getData($user)
    {
        $data = [
            'usuario' => [
                'id' => $user->id,
                'email' => $user->email,
                'estado' => $user->estado,
                'rol' => $user->rol->nombre
            ]];
        switch($user->rol->nombre){
            case 'DIRECTOR':
//                $director = Director::where('usuario_id', $user->id)->first();
//                $data['usuario']['director'] = [
//                    'id' => $director->id,
//                    'nombre' => $director->nombre,
//                ];
//
//                $data['usuario']['imagen'] =  $director->avatar;
                break;
            case 'TUTOR':
//                $tutor = Tutor::where('usuario_id', $user->id)->first();
//                $data['usuario']['tutor'] = [
//                    'id' => $tutor->id,
//                    'nombre' => $tutor->nombre,
//                ];
//
//                $data['usuario']['imagen'] =  $tutor->avatar;
                break;
            case 'ESTUDIANTE':
//                $estudiante = Estudiante::where('usuario_id', $user->id)->first();
//                $data['usuario']['nombre'] = $estudiante->nombres.' '.$estudiante->apellidos;
//                $data['usuario']['email'] = $estudiante->email;
//                $data['usuario']['identificacion'] = $estudiante->identificacion;
//                $data['usuario']['telefono'] = $estudiante->telefono;
//                $data['usuario']['imagen'] =  $estudiante->imagen;
//                $data['usuario']['id'] =  $estudiante->id;
                break;
            case 'LIDER':
//
                break;
        }
        return $data;
    }
}
