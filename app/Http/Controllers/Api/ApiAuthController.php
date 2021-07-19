<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApiAuthController extends BaseController
{

    /**
     * Login.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        $credenciales = $request->only('email', 'password');
        if(Auth::attempt($credenciales)){ 
            $usuario = Auth::user(); 
            $success['token'] =  $usuario->createToken('Taquilla')->accessToken; 
            $success['name'] =  $usuario->nombre;
   
            return $this->sendResponse($success, 'Usuario logueado correctamente.');
        } 
        else{ 
            return $this->sendError('No autorizado.', ['error'=>'No autorizado']);
        }
        
    }

    public function logout(Request $request)
    {
        $request->user()->token()->revoke();   
        return $this->sendResponse('200', 'Sesión correctamente.');
    }



}
