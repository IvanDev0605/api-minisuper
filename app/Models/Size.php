<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Size extends Model
{
    
    use HasFactory;
    

    protected $table="sizes";

    protected $filable =['id','nameSize','milliliters','unidadMedida'];
    protected $casts = [
        'created_at' => 'datetime:d-m-Y',
        'updated_at' => 'datetime:d-m-Y',
        
    ];

  

    public function obtenerTamaño(){
        $size=Size::all();
        return respConsulta('Tamaño de producto',$size); 
    }

    public function registrarTamaño($request){
        $size = new Size();
        $size->nameSize = $request->nameSize;
        $size->milliliters = $request->milliliters;
        $size->unidadMedida = $request->unidadMedida;
        
        $size->save();
        return respRegistro('Tamaño de producto',$size,true); 
    }

    public function eliminarTamaño($id){
        $tipo = Size::findOrFail($id);
        $tipo->delete();
        return respEliminar('Tamaño de producto',$tipo); 
    }
    
    
   
}
