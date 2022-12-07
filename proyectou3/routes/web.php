<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PaqueteController;
use App\Http\Controllers\EventoController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ServicioController;
use App\Http\Controllers\AbonoController;
use App\Http\Controllers\FotosController;
use App\Http\Controllers\GastosController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [PaqueteController::class, 'listarPaquetes'])->name('paquetes_index');

Auth::routes();

Route::get('/home', [PaqueteController::class, 'listarPaquetes'])->name('home');

Route::get('/admin-panel', [UserController::class, 'panelAdmin'])->name('admin_panel');

Route::prefix('paquetes')->group(function(){
    Route::get('/', [PaqueteController::class, 'listarPaquetes'])->name('paquetes_index');
    Route::get('/create', [PaqueteController::class, 'createView'])->name('paquetes_create');
    Route::post('/store', [PaqueteController::class, 'crearPaquete'])->name('paquetes_store');
    Route::get('/{id}/edit', [PaqueteController::class, 'editPaquete'])->name('paquetes_edit');
    Route::post('/{id}/update', [PaqueteController::class, 'editarPaquete'])->name('paquetes_update');
    Route::get('/{id}/destroy', [PaqueteController::class, 'destroyPaquete'])->name('paquetes_destroy');
});

Route::prefix('eventos')->group(function(){
    Route::get('/reservar/{id}', [EventoController::class, 'eventoPaquete'])->name('reservarPaquete');
    Route::post('/store', [EventoController::class, 'crearEvento'])->name('evento_store');
    Route::get('/mis-eventos', [EventoController::class, 'listarEventos'])->name('evento_index');
    Route::get('/lista', [EventoController::class, 'listaEventosAdmin'])->name('evento_admin');
    Route::get('/{id}/cambiar-estado/{estado}', [EventoController::class, 'cambiarEstado'])->name('evento_cambiar_estado');
    Route::get('/{id}/edit', [EventoController::class, 'editarEventoView'])->name('evento_edit');
    Route::post('/{id}/update', [EventoController::class, 'editarEvento'])->name('evento_update');    
    Route::delete('/{id}/destroy', [EventoController::class, 'eliminarEvento'])->name('evento_destroy');
    Route::get('/detalle-evento/{id}', [EventoController::class, 'detalleEvento'])->name('detalle_evento');

    Route::get('/empleado', [EventoController::class, 'listaEventosEmpleado'])->name('evento_empleado');
});

//usuarios
Route::prefix('usuarios')->group(function(){
    Route::get('/', [UserController::class, 'index'])->name('usuarios_index');
    Route::get('/{id}/edit', [UserController::class, 'editUsuario'])->name('usuarios_edit');    
    Route::post('/{id}/update', [UserController::class, 'editarUsuario'])->name('usuarios_update');
    Route::get('/{id}/destroy', [UserController::class, 'destroyUsuario'])->name('usuarios_destroy');
    Route::get('/create', [UserController::class, 'createUsuario'])->name('usuarios_create');
    Route::post('/store', [UserController::class, 'storeUsuario'])->name('usuarios_store');
});

//servicios
Route::prefix('servicios')->group(function(){
    Route::get('/', [ServicioController::class, 'index'])->name('servicios_index');
    Route::get('/{id}/edit', [ServicioController::class, 'editServicio'])->name('servicios_edit');    
    Route::post('/{id}/update', [ServicioController::class, 'editarServicios'])->name('servicios_update');
    Route::get('/{id}/destroy', [ServicioController::class, 'eliminarServicio'])->name('servicios_destroy');
    Route::get('/create', [ServicioController::class, 'newUser'])->name('servicios_create');
    Route::post('/store', [ServicioController::class, 'crearServicio'])->name('servicios_store');
});

Route::post('/abonar', [AbonoController::class, 'abonar'])->name('abonar');


//fotos
Route::prefix('fotos')->group(function(){
    Route::post('/create', [FotosController::class, 'addFoto'])->name('fotos_create');    
    Route::get('/{id}/destroy', [FotosController::class, 'deleteFoto'])->name('fotos_destroy');    
    Route::post('/{id}/update', [FotosController::class, 'editFoto'])->name('fotos_update');
});

//gastos
Route::post('/agregar-gasto', [GastosController::class, 'crearGatos'])->name('gasto_create');