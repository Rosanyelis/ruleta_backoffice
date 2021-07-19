<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApiAuthTaquillaController extends Controller
{
    public function login(Request $request){

        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ],[
            'email.required' => 'El Correo Electrónico es obligatorio.',
            'email.email' => 'El Correo Electrónico debe tener un formato válido',
            'password.required' => 'La Contraseña es obligatorio.',
        ]);


        // if ($validateData) {
        //     return response()->json([
        //         'status' => 403,
        //         'message' => $validateData->first(),
        //     ], 403);
        // }

        $credenciales = $request->only('email', 'password');

        if (!Auth::attempt($credenciales)) {
            return  response()->json([
                'status' => 'Credenciales inválidas',
                'message' => 'Correo o contraseña no válidos.',
            ], 401);
        }

        $usuarios = Auth::usuario();

        # falta validacion de direccion mac

        $token = $usuarios->createToken('auth_token')->plainTextToken();

        return response()->json([
            'status' => 200,
            'access_token' => $token,
            'token_type'   => 'Bearer',
        ], 200);
        
    }

    public function infoUser(Request $request)
    {
        return $request->usuario();
    }

    /**
     * Cierre de sesión
     */
    public  function  logout(Request  $request) {

        $request->Usuario()->currentAccessToken()->delete();
        return response()->json([
            'status' => 200,
            'message' => 'Cerraste sesión',
        ], 200);
        
    }
}
