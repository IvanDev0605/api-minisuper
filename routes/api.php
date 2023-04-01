<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\MakeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PromotionDetailsController;
use App\Http\Controllers\TypeProductController;
use App\Http\Controllers\TypeUserController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SizeController;

use App\Http\Controllers\PromotionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post("login", [LoginController::class, 'login']);

Route::group(['middleware' => ["auth:sanctum"]], function () {
    
    Route::group(['prefix' => 'tipoUsuario'], function () {
        Route::get("todos", [TypeUserController::class, 'verTipos']);
        Route::post("registrar", [TypeUserController::class, 'registrarTipo']);
       // Route::get("eliminar/{id}", [tipoController::class, 'eliminarTipo']);
    });

    Route::group(['prefix' => 'usuarios'], function () {
        //Route::get("perfil", [usuarioController::class, 'userProfile']);
       // Route::get("todos", [usuarioController::class, 'verUsuarios']);
        Route::post("registrar", [UserController::class, 'registrarUsuario']);
       // Route::post("editar", [usuarioController::class, 'editarUsuario']);
       // Route::post("subirImg", [usuarioController::class, 'subirImg']);
       // Route::get("eliminar/{id}", [usuarioController::class, 'eliminarUsuario']);
       // Route::get("logout", [usuarioController::class, 'logout']);
    });
    //productos
    Route::group(['prefix' => 'producto'], function () {
        Route::get("todos", [ProductController::class, 'verProductos']);
        Route::get("verProducto/{id}", [ProductController::class, 'verProducto']); 
         Route::post("registrar", [ProductController::class, 'registrarProducto']);
       Route::get("eliminar/{id}", [ProductController::class, 'eliminarProducto']);
     });

    //tipo productos
    Route::group(['prefix' => 'tipoProducto'], function () {
         Route::get("todos", [TypeProductController::class, 'verTipos']);
         Route::post("registrar", [TypeProductController::class, 'registrarTipo']);
         Route::get("eliminar/{id}", [TypeProductController::class, 'eliminarTipo']);
     });
     //marcas de productos
     Route::group(['prefix' => 'marcaProducto'], function () {
        Route::get("todos", [MakeController::class, 'verMarcas']);
         Route::post("registrar", [MakeController::class, 'registrarMarca']);
        Route::get("eliminar/{id}", [MakeController::class, 'eliminarMarca']);
     });
     /**tamaño producto */
     Route::group(['prefix' => 'tamañoProducto'], function () {
         Route::get("todos", [SizeController::class, 'verTamaño']);
         Route::post("registrar", [SizeController::class, 'registrarTamaño']);
         Route::get("eliminar/{id}", [SizeController::class, 'eliminarTamaño']);
     });
         /**promociones*/
         Route::group(['prefix' => 'promocion'], function () {
            Route::get("todos", [PromotionController::class, 'verPromociones']);
            Route::post("registrar", [PromotionController::class, 'registrarPromocion']);
            Route::get("eliminar/{id}", [PromotionController::class, 'eliminarPromocion']);
        });

        /**detalles promocion */
        Route::group(['prefix' => 'detallePromocion'], function () {
            Route::get("todos", [PromotionDetailsController::class, 'verDetallePromocion']);
            Route::post("registrar", [PromotionDetailsController::class, 'registrarDetallePromocion']);
            Route::get("eliminar/{id}", [PromotionDetailsController::class, 'eliminarDetallePromocion']);
        });


});




Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
