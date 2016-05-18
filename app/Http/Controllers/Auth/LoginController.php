<?php

namespace App\Http\Controllers\Auth;

use App\Models\Director;
use App\Models\Estudiante;
use App\Models\Tutor;
use Illuminate\Http\Request;

use App\Models\Usuario;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;

use App\Http\Requests;
use App\Http\Controllers\Controller;


class LoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('jwt.auth', ['except' => ['autenticarUsuario']]);
    }

    public function autenticarUsuario(Request $request)
    {
        // credenciales para loguear al usuario
        $credentials['email'] = $request->get('name');
        $credentials['password'] = $request->get('pass');

        try {
            $user = Usuario::where('email', $credentials['email'])->first();
            if ($user && password_verify($credentials['password'], $user->password)) {
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
        if (!$token) {
            return response()->json(['Token no proporcionado'], 401);
        }
        try {
            $token = JWTAuth::refresh($token);
        } catch (TokenInvalidException $e) {
            return response()->json(['messageError' => $e->getMessage()], 403);
        }
        return response()->json(['token' => $token]);
    }

    private function getData($user)
    {
        $data = [
            'usuario' => [
                'usuario_id' => $user->id,
                'email' => $user->email,
                'estado' => $user->estado,
                'roles' => $user->roles
            ]];
        foreach ($user->roles as $rol) {
            switch ($rol->nombre) {
                case 'DIRECTOR':
                    $director = Director::where('usuario_id', $user->id)->first();
                    if ($director) {
                        $data['usuario']['datos'] = [
                            'id' => $director->id,
                            'nombres' => $director->nombres,
                            'apellidos' => $director->apellidos,
                            'identificacion' => $director->identificacion
                        ];
                    }
                    break;
                case 'TUTOR':
                $tutor = Tutor::where('usuario_id', $user->id)->first();
                    if($tutor){
                        $data['usuario']['datos'] = [
                            'id' => $tutor->id,
                            'nombres' => $tutor->nombres,
                            'apellidos' => $tutor->apellidos,
                            'identificacion' => $tutor->identificacion
                        ];
                    }
                    break;
                case 'ESTUDIANTE':
                    $estudiante = Estudiante::where('usuario_id', $user->id)->first();
                    if($estudiante){
                        $data['usuario']['datos'] = [
                            'nombres' => $estudiante->nombres,
                            'apellidos' => $estudiante->apellidos,
                            'identificacion' => $estudiante->identificacion,
                            'celular' => $estudiante->telefono,
                            'id' => $estudiante->id,
                        ];
                    }
                    break;
                case 'LIDER':
//
                    break;
            }
        }

        return $data;
    }
}
