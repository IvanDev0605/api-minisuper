<?php

namespace App\Http\Controllers;

use App\Models\TypeUser;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class TypeUserController extends Controller
{
    public function verTipos(){
       
        $user = User::find(auth()->user()->id)->tipo;
        if ($user["nameType"] != "Desarrollador" && $user["nameType"] != "Gerente") {
            return respPermisos(false, "crear tipos");
        }
       
     $tipo= new TypeUser();
    return $tipo->obtenerTipos();
    }


    public function registrarTipo(Request $request)
    {
        $request->validate(
            [
                'nameType' => 'required|unique:typeuser',
                'descriptionType' => 'required'

            ],
            [
                'nameType.unique' => 'El rol ya esta registrado',
                'descriptionType.required' => 'Hace falta una descripción',
                'nameType.required' => 'Hace falta el nombre',
            ]
        );

        // $user = usuario::with('tipo')->find(auth()->user()->id);
        $user = User::find(auth()->user()->id)->tipo;
        if ($user["nameType"] != "Desarrollador" && $user["nameType"] != "Gerente") {
            return respPermisos(false, "crear tipos");
        }

        $tipo = new TypeUser();

        return $tipo->registrarTipo($request);
    }



}
