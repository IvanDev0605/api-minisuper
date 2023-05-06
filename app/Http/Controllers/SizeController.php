<?php

namespace App\Http\Controllers;

use App\Models\Size;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class SizeController extends Controller
{

    public function registrarTamaño(Request $request)
    {
        $request->validate(
            [
                'nameSize' => 'required|unique:sizes',
                'milliliters' => 'required|numeric|min:1',
                'unidadMedida' =>'required'

                
            ],
            [
                'nameSize.unique' => 'El tipo ya esta registrado',
                'milliliters.required' => 'Hace falta la cantidad',
                'unidadMedida.required' => 'Hace falta la descripción',
                'milliliters.numeric' => 'La cantidad debe ser numérica',    
                'milliliters.min' => 'La cantidad debe ser mayor a 0',
              
            ]
        );

        // $user = usuario::with('tipo')->find(auth()->user()->id);
        $user = User::find(auth()->user()->id)->tipo;
        if ($user["nameType"] != "Desarrollador" && $user["nameType"] != "Gerente") {
            return respPermisos(false, "crear tipos");
        }

        $size = new Size();

        return $size->registrarTamaño($request);
    }



    
    public function verTamaño(){

        $user = User::find(auth()->user()->id)->tipo;
        if ($user["nameType"] != "Desarrollador" && $user["nameType"] != "Gerente") {
            return respPermisos(false, "crear tipos");
        }

     $size= new Size();
    return $size->obtenerTamaño();
    }


    
    public function eliminarTamaño($id){
   
        $user = User::find(auth()->user()->id)->tipo;
        if ($user["nameType"] != "Desarrollador" && $user["nameType"] != "Gerente") {
            return respPermisos(false, "crear tipos");
        }

        $size= new Size();
        return $size->eliminarTamaño($id);
    }
}
