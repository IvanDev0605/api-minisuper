<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;

class Make extends Model
{
    
    use HasFactory;
    

    protected $table="makesproduct";

    protected $filable =['id','nameMake','imgMake'];
    protected $casts = [
        'created_at' => 'datetime:d-m-Y',
        'updated_at' => 'datetime:d-m-Y',
        
    ];

  

    public function obtenerMarcas(){
        $marca=Make::all();
        return respConsulta('Marca de producto',$marca); 
    }

    public function registrarMarca($resquest){
        $marca = new Make();
        $marca->nameMake = $resquest->nameMake;
        $marca->imgMake = $resquest->imgMake;
        $marca->save();
        return respRegistro('marca de producto',$marca,true); 
    }

    public function eliminarMarca($id){
        $marca = Make::findOrFail($id);
        $marca->delete();
      //  $ruta =public_path($marca->imgMake);
        //File::deleteDirectory($ruta);
        return respEliminar('marca de producto',$marca); 
    }
    
    
   
}
