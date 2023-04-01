<?php

namespace App\Http\Controllers;

use App\Models\Promotion;
use App\Models\User;
use Illuminate\Http\Request;

class PromotionController extends Controller
{
    public function registrarPromocion(Request $request)
    {
        $request->validate(
            [
                
                'promoName'=>'required|unique:promotions',
                'promoDescription'=>'required',
                'promoPrice'=>'required'
                
            ],
            [
            ]
        );

        // $user = usuario::with('tipo')->find(auth()->user()->id);
        $user = User::find(auth()->user()->id)->tipo;
        if ($user["nameType"] != "Desarrollador" && $user["nameType"] != "Gerente") {
            return respPermisos(false, "crear tipos");
        }

        $promociones = new Promotion();

        return $promociones->registrarPromociones($request);
    }

    public function verPromociones(){

        $user = User::find(auth()->user()->id)->tipo;
        if ($user["nameType"] != "Desarrollador" && $user["nameType"] != "Gerente") {
            return respPermisos(false, "crear tipos");
        }

     $promociones= new Promotion();
    return $promociones->obtenerPromociones();
    }

    public function eliminarPromocion($id){
   
        $user = User::find(auth()->user()->id)->tipo;
        if ($user["nameType"] != "Desarrollador" && $user["nameType"] != "Gerente") {
            return respPermisos(false, "crear tipos");
        }

        $promociones= new Promotion();
        return $promociones->eliminarPromociones($id);
    }

}
