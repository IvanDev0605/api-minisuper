<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\File;
use App\Models\Make;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class MakeController extends Controller
{

    public function registrarMarca(Request $request)
    {
        $request->validate(
            [
                'nameMake' => 'required|unique:makesproduct',
                'imgMake' => 'required|mimes:png,jpg,jpeg'

                
            ],
            [
                'nameMake.unique' => 'El tipo ya esta registrado',
                'imgMake.required' => 'Hace falta la imagen',
                'imgMake.mimes' => 'El archivo a enviar, no es una imagen válida',
                'nameMake.required' => 'Hace falta el nombre',
            ]
        );

        // $user = usuario::with('tipo')->find(auth()->user()->id);
        $user = User::find(auth()->user()->id)->tipo;
        if ($user["nameType"] != "Desarrollador" && $user["nameType"] != "Gerente") {
            return respPermisos(false, "crear Marca");
        }

        $rutaPrincipal = public_path('img/imgMakes');
        if(!File::isDirectory($rutaPrincipal)){
            File::makeDirectory($rutaPrincipal,0777,TRUE,TRUE);
          //  return respRegistro('se creo el directorio marcas',null, false);
        }
        if($request->hasFile('imgMake')){
            $imagen = $request->file('imgMake');
            $nombreImg= $imagen->getClientOriginalName();
            $imageName = pathinfo($nombreImg, PATHINFO_FILENAME); // obtiene el nombre del archivo sin la extensión
            $imageName = $imageName . '_' . uniqid() . '.' . $request->file('imgMake')->getClientOriginalExtension();
           
            $imagen->move($rutaPrincipal,$imageName);
            
            $request->imgMake = 'img/imgMakes'.'/'.$imageName;
         }

        $marca = new Make();

        return $marca->registrarMarca($request);
    }

    public function verMarcas(){

        $user = User::find(auth()->user()->id)->tipo;
        if ($user["nameType"] != "Desarrollador" && $user["nameType"] != "Gerente") {
            return respPermisos(false, "crear tipos");
        }

     $marca= new Make();
    return $marca->obtenerMarcas();
    }

    public function eliminarMarca($id){
   
        $user = User::find(auth()->user()->id)->tipo;
        if ($user["nameType"] != "Desarrollador" && $user["nameType"] != "Gerente") {
            return respPermisos(false, "crear tipos");
        }

        $marca= new Make();
        return $marca->eliminarMarca($id);
    }


}
