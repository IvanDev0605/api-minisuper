<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class TypeProduct extends Model
{
    
    use HasFactory;
    

    protected $table="typesProducts";

    protected $filable =['id','typeProduct'];
    protected $casts = [
        'created_at' => 'datetime:d-m-Y',
        'updated_at' => 'datetime:d-m-Y',
        
    ];

  

    public function obtenerTipos(){
        $tipo=TypeProduct::all();
        return respConsulta('tipos de producto',$tipo); 
    }

    public function registrarTipo($resquest){
        $tipo = new TypeProduct();
        $tipo->typeProduct = $resquest->typeProduct;
        $tipo->descriptionType = $resquest->descriptionType;
        $tipo->save();
        return respRegistro('tipo de producto',$tipo,true); 
    }

    public function eliminarTipo($id){
        $tipo = TypeProduct::findOrFail($id);
        $tipo->delete();
        return respEliminar('tipo de producto',$tipo); 
    }
    
    
   
}
