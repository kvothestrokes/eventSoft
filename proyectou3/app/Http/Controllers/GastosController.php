<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Gastos;

class GastosController extends Controller
{
    //
    public function crearGatos(Request $request){
        $gasto = new Gastos();
        $gasto->concepto = $request->concepto;
        $gasto->monto = $request->monto;
        $gasto->id_evento = $request->id_evento;        
        $gasto->save();
        return redirect()->back();
    }
}
