<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class TypeUser extends Model
{
    
    use HasFactory;
    

    protected $table="TypeUser";

    protected $filable =['id','nameType','descriptionType'];
    protected $casts = [
        'created_at' => 'datetime:d-m-Y',
        'updated_at' => 'datetime:d-m-Y',
        
    ];

  

    public function obtenerTipos(){
        $tipo=TypeUser::all();
        return respConsulta('tipos de usuarios',$tipo); 
    }

    public function registrarTipo($resquest){
        $tipo = new TypeUser();
        $tipo->nameType = $resquest->nameType;
        $tipo->descriptionType = $resquest->descriptionType;
        $tipo->save();
        return respRegistro('tipo de usuario',$tipo,true); 
    }

    public function eliminarTipo($id){
        $tipo = TypeUser::findOrFail($id);
        $tipo->delete();
        return respEliminar('tipo usuario',$tipo); 
    }
    
    
   
}
