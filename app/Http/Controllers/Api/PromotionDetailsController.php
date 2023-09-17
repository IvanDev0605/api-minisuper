<?php

namespace App\Http\Controllers\Api;

use App\Models\detailsPromo;
use App\Models\Promotion;
use App\Models\Product;
use App\Models\User;

use Illuminate\Http\Request;

class PromotionDetailsController extends Controller
{
    public function registrarDetallePromocion(Request $request)
    {
        $request->validate([
            'idPromo' => 'required|exists:promotions,id',
            'idProduct' => 'required|exists:products,id',
            'quantityPieces' => 'required|numeric|min:1',
        ], [
            'idPromo.required' => 'El ID de la promoción es obligatorio.',
            'idPromo.exists' => 'La promoción seleccionada no existe.',
            'idProduct.required' => 'El código del producto es obligatorio.',
            'idProduct.exists' => 'El producto seleccionado no existe.',
            'quantityPieces.required' => 'La cantidad de piezas es obligatoria.',
            'quantityPieces.numeric' => 'La cantidad de piezas debe ser un número.',
            'quantityPieces.min' => 'La cantidad de piezas debe ser mayor a 0.',
        ]);


        // $user = usuario::with('tipo')->find(auth()->user()->id);
        $user = User::find(auth()->user()->id)->tipo;
        if ($user["nameType"] != "Desarrollador" && $user["nameType"] != "Gerente") {
            return respPermisos(false, "crear tipos");
        }

        $detallePromo = new detailsPromo();

        return $detallePromo->registrarDetalles($request);
    }

    public function verDetallePromocion($id)
    {

        $user = User::find(auth()->user()->id)->tipo;
        if ($user["nameType"] != "Desarrollador" && $user["nameType"] != "Gerente") {
            return respPermisos(false, "crear tipos");
        }

        $detallePromo = new detailsPromo();
        return $detallePromo->verDetalles($id);
    }

    public function eliminarPromocion($id)
    {

        $user = User::find(auth()->user()->id)->tipo;
        if ($user["nameType"] != "Desarrollador" && $user["nameType"] != "Gerente") {
            return respPermisos(false, "crear tipos");
        }

        $promociones = new Promotion();
        return $promociones->eliminarPromociones($id);
    }
}
