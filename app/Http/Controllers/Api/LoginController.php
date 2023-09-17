<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller\Api;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class loginController extends Controller
{
    public function login(Request $request)
    {

        $request->validate(
            [
                'userName' => 'required',
                'password' => 'required',
            ],
            [
                'userName.required' => 'Ingresa el usuario',
                'password.required' => 'Ingresa la contraseña'
            ]
        );
        $usuario = User::where("userName", "=", $request->userName)->first();

        if (!empty($usuario)) {
            if (Hash::check($request->password, $usuario->password)) {
                $token = $usuario->createToken("auth_token")->plainTextToken;
                return response()->json(
                    [
                        "status" => true,
                        "msg" => "¡Usuario logueado correctamente!",
                        "access_token" => $token
                    ]
                );
            } else {
                return response()->json(
                    [
                        "status" => false,
                        "msg" => "algún dato es incorrecto!",


                    ]
                );
            }
        } else {
            return response()->json(
                [
                    "status" => false,
                    "msg" => "Usuario no registrado!"
                ]
            );
        }
    }
}
