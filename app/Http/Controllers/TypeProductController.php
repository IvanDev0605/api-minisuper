<?php

namespace App\Http\Controllers;

use App\Models\TypeProduct;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class TypeProductController extends Controller
{

    public function registrarTipo(Request $request)
    {
        $request->validate(
            [
                'typeProduct' => 'required|unique:typesproducts',
                'descriptionType' => 'required'

                
            ],
            [
                'typeProduct.unique' => 'El tipo ya esta registrado',
                'descriptionType.required' => 'Hace falta la descripción',
                'typeProduct.required' => 'Hace falta el nombre',
            ]
        );

        // $user = usuario::with('tipo')->find(auth()->user()->id);
        $user = User::find(auth()->user()->id)->tipo;
        if ($user["nameType"] != "Desarrollador" && $user["nameType"] != "Gerente") {
            return respPermisos(false, "crear tipos");
        }

        $tipo = new TypeProduct();

        return $tipo->registrarTipo($request);
    }

    public function verTipos(){

        $user = User::find(auth()->user()->id)->tipo;
        if ($user["nameType"] != "Desarrollador" && $user["nameType"] != "Gerente") {
            return respPermisos(false, "crear tipos");
        }

     $tipo= new TypeProduct();
    return $tipo->obtenerTipos();
    }

    public function eliminarTipo($id){
   
        $user = User::find(auth()->user()->id)->tipo;
        if ($user["nameType"] != "Desarrollador" && $user["nameType"] != "Gerente") {
            return respPermisos(false, "crear tipos");
        }

        $type= new TypeProduct();
        return $type->eliminarTipo($id);
    }


}
