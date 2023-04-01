<?php

namespace App\Http\Controllers;

use App\Models\detailsPromo;
use App\Models\Promotion;
use App\Models\User;

use Illuminate\Http\Request;

class PromotionDetailsController extends Controller
{
    public function registrarDetallePromocion(Request $request)
    {
        $request->validate(
            [
                
                'idPromo'=>'required',
                'idProduct'=> 'required',
               
                'quantityPieces'=>'required',
                
                
            ],
            [
            ]
        );

        // $user = usuario::with('tipo')->find(auth()->user()->id);
        $user = User::find(auth()->user()->id)->tipo;
        if ($user["nameType"] != "Desarrollador" && $user["nameType"] != "Gerente") {
            return respPermisos(false, "crear tipos");
        }

        $detallePromo = new detailsPromo();

        return $detallePromo->registrarDetalles($request);
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
