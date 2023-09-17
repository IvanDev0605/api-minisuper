<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Facades\File;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{

    public function registrarProducto(Request $request)
    {
        $request->validate(
            [


                'idMake' => 'required',
                'idType' => 'required',
                'idSize' => 'required',
                'codeProduct' => 'required|unique:products',
                'nameProduct' => 'required|unique:products',
                'imgProduct' => 'required|mimes:png,jpg,jpeg',
                'stock' => 'required',
                'purchasePrice' => 'required',
                'salePrice' => 'required',

            ],
            [
                'nameProduct.unique' => 'El nombre del producto ya esta registrado',
                'codeProduct.unique' => 'El código ya esta registrado',
                'imgMake.required' => 'Hace falta la imagen',
                'imgProduct.mimes' => 'El archivo a enviar, no es una imagen válida',

            ]
        );

        // $user = usuario::with('tipo')->find(auth()->user()->id);
        $user = User::find(auth()->user()->id)->tipo;
        if ($user["nameType"] != "Desarrollador" && $user["nameType"] != "Gerente") {
            return respPermisos(false, "crear producto");
        }

        $rutaPrincipal = public_path('img/imgProduct');
        if (!File::isDirectory($rutaPrincipal)) {
            File::makeDirectory($rutaPrincipal, 0777, TRUE, TRUE);
            //  return respRegistro('se creo el directorio marcas',null, false);
        }
        if ($request->hasFile('imgProduct')) {
            $imagen = $request->file('imgProduct');
            $nombreImg = $imagen->getClientOriginalName();
            $imageName = pathinfo($nombreImg, PATHINFO_FILENAME); // obtiene el nombre del archivo sin la extensión
            $imageName = $imageName . '_' . uniqid() . '.' . $request->file('imgProduct')->getClientOriginalExtension();

            $imagen->move($rutaPrincipal, $imageName);

            $request->imgProduct = 'img/imgProduct' . '/' . $imageName;
        }

        $producto = new Product();

        return $producto->registrarProducto($request);
    }

    public function verProductos()
    {

        $user = User::find(auth()->user()->id)->tipo;
        if ($user["nameType"] != "Desarrollador" && $user["nameType"] != "Gerente") {
            return respPermisos(false, "crear tipos");
        }

        $producto = new Product();
        return $producto->obtenerProductos();
    }

    public function verProducto($id)
    {

        Validator::make(['id' => $id], [
            "id" => "required|numeric|min:1",
        ], [
            "id.required" => "Ingresa el código de barras",
            "id.numeric" => "El formato del código no es correcto",
            "id.min" => "No puedes mandar códigos negativos"
        ])->validate();
        // Resto del código para obtener y mostrar el producto


        $user = User::find(auth()->user()->id)->tipo;
        if ($user["nameType"] != "Desarrollador" && $user["nameType"] != "Gerente") {
            return respPermisos(false, "crear tipos");
        }
        $producto = new Product();
        return $producto->obtenerProducto($id);
    }

    public function eliminarProducto($id)
    {

        $user = User::find(auth()->user()->id)->tipo;
        if ($user["nameType"] != "Desarrollador" && $user["nameType"] != "Gerente") {
            return respPermisos(false, "crear tipos");
        }

        $producto = new Product();
        return $producto->eliminarProducto($id);
    }
}
