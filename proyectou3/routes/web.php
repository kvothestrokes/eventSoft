<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PaqueteController;
use App\Http\Controllers\EventoController;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [PaqueteController::class, 'listarPaquetes'])->name('home');

Route::prefix('paquetes')->group(function(){
    Route::get('/', [PaqueteController::class, 'listarPaquetes'])->name('paquetes_index');
    // Route::get('/create', [PaqueteController::class, 'create'])->name('paquetes_create');
    // Route::post('/store', [PaqueteController::class, 'store'])->name('paquetes_store');
    // Route::get('/{id}/edit', [PaqueteController::class, 'edit'])->name('paquetes_edit');
    // Route::put('/{id}/update', [PaqueteController::class, 'update'])->name('paquetes_update');
    // Route::delete('/{id}/destroy', [PaqueteController::class, 'destroy'])->name('paquetes_destroy');
});

Route::prefix('evento')->group(function(){
    Route::get('/reservar/{id}', [EventoController::class, 'eventoPaquete'])->name('reservarPaquete');
    // Route::get('/', [EventoController::class, 'index'])->name('evento_index');
    // Route::get('/create', [EventoController::class, 'create'])->name('evento_create');
    // Route::post('/store', [EventoController::class, 'store'])->name('evento_store');
    // Route::get('/{id}/edit', [EventoController::class, 'edit'])->name('evento_edit');
    // Route::put('/{id}/update', [EventoController::class, 'update'])->name('evento_update');
    // Route::delete('/{id}/destroy', [EventoController::class, 'destroy'])->name('evento_destroy');
});