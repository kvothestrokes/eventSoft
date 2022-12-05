<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\abono;

class AbonoController extends Controller
{
    //
    public function abonar(Request $request){
        $abono = new Abono();
        $abono->id_evento = $request->id_evento;        
        $abono->monto = $request->monto;
        $abono->save();
        return redirect()->back();
    }
    
}
