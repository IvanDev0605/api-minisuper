<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function registrarUsuario(Request $request)
    {
        $request->validate(
            [
                //|mimes:png,jpg,jpeg
                'userName' => 'required|unique:users',
                'idType' => 'required',
                'email' => 'required|unique:users',
                'password' => 'required',


            ],
            [
                'userName.unique' => 'El usuario ya esta registrado',
                'email.unique' => 'El Correo ya esta registrado',
                //'Img.image'=> 'El archivo a enviar, no es una imagen'
            ]
        );
        $user = User::find(auth()->user()->id)->tipo;
        if ($user["nameType"] != "Desarrollador" && $user["nameType"] != "Gerente") {
            return respPermisos(false, "crear usuarios");
        }

        $usuario = new User();



        return  $usuario->registrarUsuario($request);
    }
}
