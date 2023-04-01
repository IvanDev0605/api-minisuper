<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\TypeUser;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;


class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table ="users";

    protected $filable =['idType','userName','email','password'];

  //  protected $hidden = [
    //    'Contraseña'
    //];

    public function obtenerUsuarios(){
        //$usuario=usuario::all();
      
        
        return respConsulta('usuario','usuario'); 
    }

    public function registrarUsuario($request){
        $usuario = new User();
        $usuario->idType= $request->idType;
        $usuario->userName= $request->userName;
        $usuario->email= $request->email;
        $usuario->password=Hash::make($request->password);
        $usuario->save();
        return respRegistro('usuario',$usuario,true); 
    }
    
    public function editarUsuario($request,$permiso){
        $usuario = User::find(auth()->user()->id);
        $usuario->idType= $request->idType;
        $usuario->userName= $request->userName;
        $usuario->email= $request->email;
        $usuario->password=Hash::make($request->password);
        $usuario->save();
        return respRegistro('usuario',$usuario,true); 
    }


    public function eliminarUsuario($id){

        $usuario = User::findOrFail($id);
        $usuario->delete();
       
        return respEliminar('usuario',$usuario); 
        
    }



    public function obtenerPerfil(){
        //$usuario=usuario::all();
      
        
        return respConsulta('usuario','$usuario'); 
    }

    


    protected $hidden = [
        'Contraseña',
        
    ];

    protected $casts = [
        'created_at' => 'datetime:d-m-Y',
        'updated_at' => 'datetime:d-m-Y',
        
    ];




    public function tipo() {
        return $this->belongsTo(TypeUser::class, 'idType','id');
    }

    public function verificarPermisos($user){
 
        
        if($user["Nombre"]!="Desarrolla"){
          return respPermisos(false, "ver tipos");
        }     
    
    }


}
