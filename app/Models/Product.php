<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Make;
use App\Models\TypeProduct;
use App\Models\Size;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;


class Product extends Model
{
    
    use HasFactory;
    

    protected $table="products";

    protected $filable =['id','idUser','idMake','idType','idSize','codeProduct',
                         'nameProduct','imgProduct','stock','purchasePrice','salePrice'];
    protected $casts = [
        'created_at' => 'datetime:d-m-Y',
        'updated_at' => 'datetime:d-m-Y',
        
    ];

  

  //  public function obtenerProducto(){
    //    $Producto=Product::all();
      //  return respConsulta('ver productos',$Producto); 
    //}
    /*idUser
idMake
idType
idSize
codeProduct
nameProduct
imgProduct
stock
purchasePrice
salePrice*/

    public function registrarProducto($resquest){
        $Producto = new Product();
        $Producto->idUser=auth()->user()->id;;
        $Producto->idMake=$resquest->idMake;
        $Producto->idType=$resquest->idType;
        $Producto->idSize=$resquest->idSize;
        $Producto->codeProduct=$resquest->codeProduct;
        $Producto->nameProduct=$resquest->nameProduct;
        $Producto->imgProduct=$resquest->imgProduct;
        $Producto->stock=$resquest->stock;
        $Producto->purchasePrice=$resquest->purchasePrice;
        $Producto->salePrice=$resquest->salePrice;
   
        $Producto->save();
        return respRegistro(' producto',$Producto,true); 
    }

    public function eliminarProducto($id){
        $Producto = Product::findOrFail($id);
        $Producto->delete();
        File::deleteDirectory($Producto->imgProduct);
        return respEliminar('producto',$Producto); 
    }

    public function obtenerProducto($id){
        $producto = Product::with(['makesproduct'=> function($query){
            $query->select('id','nameMake');
         },'typeProduct' => function($query){
            $query->select('id','typeProduct');
         },'size
         '=> function($query){
             $query->select('id','nameSize','milliliters');
          }])->where('codeProduct',$id)
          ->get();
         
        return respConsulta('producto',$producto); 
        


    }
    
    
    public function obtenerProductos(){
        
        $producto = Product::with(['makesproduct'=> function($query){
           $query->select('id','nameMake');
        },'typeProduct' => function($query){
           $query->select('id','typeProduct');
        },'size'=> function($query){
            $query->select('id','nameSize','milliliters');
         }])->get();
        
       return respConsulta('producto',$producto); 
   }
    
   public function makesproduct()
{
    return $this->belongsTo(Make::class, 'idMake','id');
}

public function typeProduct()
{
    return $this->belongsTo(TypeProduct::class, 'idType','id');
}
public function size()
{
    return $this->belongsTo(Size::class, 'idSize','id');
}
    


}
