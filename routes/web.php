<?php


use App\Models\Categoria;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\UnidadController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\VentaController;

Route::get('/', function () {
    return view('login');
});

Route::get('/',[UserController::class,'showLogin']);
Route::post('/identificacion', [UserController::class,'verificalogin'])->name('identificacion');
Route::get("/home", [HomeController::class, "index"])->name("home");

//CATEGORIAS

Route::resource("/categorias", CategoriaController::class);
Route::get('categorias/{IdCategoria}/confirmar', [CategoriaController::class, 'confirmar'])->name('categorias.confirmar'); 
Route::get('/cancelar1', [CategoriaController::class, 'cancelar'])->name('categorias.cancelar');


//UNIDADES

Route::resource("/unidades", UnidadController::class);
Route::get('unidades/{IdUnidad}/confirmar', [UnidadController::class, 'confirmar'])->name('unidades.confirmar'); 
Route::get('/cancelar2', [UnidadController::class, 'cancelar'])->name('unidades.cancelar');



//PRODUCTOS
Route::resource("/productos", ProductoController::class);
Route::get('productos/{IdProducto}/confirmar', [ProductoController::class, 'confirmar'])->name('productos.confirmar'); 
Route::get('/cancelar3', [ProductoController::class, 'cancelar'])->name('productos.cancelar');


//CLIENTES
Route::resource("/clientes", ClienteController::class);
Route::get('clientes/{IdCliente}/confirmar', [ClienteController::class, 'confirmar'])->name('clientes.confirmar'); 
Route::get('/cancelar4', [ClienteController::class, 'cancelar'])->name('clientes.cancelar');

//VENTAS
Route::resource("/ventas", VentaController::class);
//Route::get('ventas/{IdVenta}/confirmar', [VentaController::class, 'confirmar'])->name('ventas.confirmar'); 
//Route::get('/cancelar5', [VentaController::class, 'cancelar'])->name('ventas.cancelar');

Route::get('EncontrarProducto/{IdProducto}', [VentaController::class, 'ProductoCodigo']); 
Route::get('EncontrarTipo/{idtipo}', [VentaController::class, 'PorTipo']); 

