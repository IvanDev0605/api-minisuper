<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\Promotion;
use App\Models\Product;
use App\Models\Make;
use App\Models\TypeProduct;
use App\Models\Size;

class detailsPromo extends Model
{
    use HasFactory;
    

    protected $table="details_promo";

    protected $filable =['id','idProduct','idPromo','quantityPieces'];
    protected $casts = [
        'created_at' => 'datetime:d-m-Y',
        'updated_at' => 'datetime:d-m-Y',
        
    ];


    public function registrarDetalles($resquest){
        $detallePromocion = DB::table('details_promo')
        ->where('idProduct', $resquest->idProduct)
        ->where('idPromo', $resquest->idPromo)
        ->first();

        if ($detallePromocion) {
            return respRegistro('ya existe este producto en la promocion',null,false);  
        } else {
            $detailPromo = new detailsPromo();
            $detailPromo->idProduct = $resquest->idProduct;
            $detailPromo->idPromo = $resquest->idPromo;
            $detailPromo->quantityPieces = $resquest->quantityPieces;
            $detailPromo->save();
            return respRegistro('se registro como detalle del producto',$detailPromo,true); 
        }
        
    }


    public function verDetalles($id){

        $detallePromocion = detailsPromo::with([
            'Product'=> function($query){
                $query->select('id','nameProduct','codeProduct','imgProduct','idType','idSize')
                    ->with([
                        'typeProduct' => function($query) {
                            $query->select('id', 'typeProduct');
                        },
                        'size' => function($query) {
                            $query->select('id', 'nameSize', 'milliliters');
                        }
                    ]);
            }
        ])->where('idPromo', $id)
        ->get();
        
        return respConsulta('producto',$detallePromocion); 
        
    }
  

    
    
    public function product()
    {
        return $this->belongsTo(Product::class, 'idProduct','id');
    }

      
    public function promo()
    {
        return $this->belongsTo(Promotion::class, 'idPromo','id');
    }

   
}
