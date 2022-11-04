<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Evento;
use Illuminate\Support\Facades\Auth;

class EventoController extends Controller
{
    //
    public function listarEventos(){
        //events of the user
        $user = Auth::user();
        $eventos = Evento::where('id_usuario', $user->id )->get();
        
        return view('eventos', compact('eventos'));
    }

    public function crearEvento(Request $request){
        $user = Auth::user();
        $evento = new Evento();
        $evento->nombre = $request->nombre;        
        $evento->fecha = $request->fecha;             
        $evento->id_usuario = $user->id;
        $evento->id_paquete = $request->id_paquete;

        $evento->save();

        return redirect()->route('eventos');
    }

    public function eliminarEvento($id){
        $evento = Evento::find($id);
        $evento->delete();

        return redirect()->route('eventos');
    }

    public function editarEvento(Request $r ,Evento $id){
        $evento = Evento::find($id);
        $evento->update([
            'nombre' => $r->nombre,            
            'fecha' => $r->fecha,   
            'estado' => $r->estado,
        ]);

        return view('eventos');
    }

}
