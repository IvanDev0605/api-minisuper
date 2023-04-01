<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;

class Promotion extends Model
{
    
    use HasFactory;
    

    protected $table="promotions";

    protected $filable =['id','promoName','promoDescription','promoPrice'];
    protected $casts = [
        'created_at' => 'datetime:d-m-Y',
        'updated_at' => 'datetime:d-m-Y',
        
    ];

  

    public function obtenerPromociones(){
      $promociones = Promotion::all();
        
       return respConsulta('Promociones',$promociones); 
    }

    public function registrarPromociones($resquest){
        $promociones = new Promotion();
       $promociones->promoName  = $resquest->promoName;
        $promociones->promoDescription = $resquest->promoDescription;
        
        $promociones->promoPrice = $resquest->promoPrice;
        $promociones->save();
        return respRegistro('Promoción',$promociones,true); 
    }

    public function eliminarPromociones($id){
        $promocion = Promotion::with('detailsPromo')->findOrFail($id);
        foreach ($promocion->detailsPromo as $detalle) {
            $detalle->delete();
        }

        $promocion->delete();
       
        return respEliminar('Promoción',$promocion); 
    }
    
  
    public function detailsPromo()
    {
        return $this->hasMany(detailsPromo::class,"idPromo","id");
    }  
   
}
