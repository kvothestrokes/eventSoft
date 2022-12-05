<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Evento;
use App\Models\Paquete;
use App\Models\Paqueteservicio;
use App\Models\abono;
use Illuminate\Support\Facades\Auth;

class EventoController extends Controller
{       

    public function listarEventos(){
        //events of the user
        $user = Auth::user();
        $eventos = Evento::where('id_usuario', $user->id )->get();
        // dd($eventos);
        return view('eventos', compact('eventos'));
    }

    public function listaEventosAdmin(){        
        $eventos = Evento::all();        
        return view('admin.eventos_list', compact('eventos'));
    }

    public function cambiarEstado($id, $estado){
        $evento = Evento::find($id);
        $evento->estado = $estado;

        //rechazado por
        if($estado == 'rechazado'){
            $evento->rechazado_por = Auth::user()->name;
        }

        $evento->save();
        return redirect()->route('evento_admin');
    }

    public function eventoPaquete($id){
        
        $paquete = Paquete::find($id);
        $services = Paqueteservicio::where('id_paquete', $paquete->id)->get();
        $paquete->services = $services;        
        // dd($paquete);
        return view('reservar', [
            'paquete' => $paquete,
        ]);

        return;
    }

    public function detalleEvento($id){

        $evento = Evento::find($id);

        $id_paquete = $evento->id_paquete;        
        $paquete = Paquete::find($id_paquete);        
        $services = Paqueteservicio::where('id_paquete', $paquete->id)->get();        
        $paquete->services = $services;  

        $abonos = Abono::where('id_evento', $evento->id)->get();

        $total_abonos = 0;
        foreach($abonos as $abono){
            $total_abonos += $abono->monto;
        }

        return view('admin.evento_view', [
            'evento' => $evento,
            'paquete' => $paquete,
            'abonos' => $abonos,
            'total_abonos' => $total_abonos,
            'total' => $paquete->precio-$total_abonos,
        ]);
    }

    public function crearEvento(Request $request){
        $user = Auth::user();
        $evento = new Evento();
        $evento->nombre = $request->nombre;        
        $evento->fecha_evento_inicio = $request->fecha;             
        $evento->id_usuario = $user->id;
        $evento->hora_evento_inicio = $request->hora_inicio;
        $evento->hora_evento_fin = $request->hora_fin;
        $evento->id_paquete = $request->id_paquete;
        $evento->estado = 'pendiente';

        $evento->save();

        return redirect()->route('evento_index');
    }

    public function eliminarEvento($id){
        $evento = Evento::find($id);
        $evento->delete();

        return redirect()->route('evento_index');
    }

    public function editarEventoView($id){        
        $evento = Evento::find($id);        
        $id_paquete = $evento->id_paquete;        
        $paquete = Paquete::find($id_paquete);        
        $services = Paqueteservicio::where('id_paquete', $paquete->id)->get();        
        $paquete->services = $services;  

        return view('reservar_edit', [
            'evento' => $evento,
            'paquete' => $paquete,
        ]);
    }

    public function editarEvento(Request $r ,$id){
        $evento = Evento::where('id',$id)->first();        
        $evento->update([
            'nombre' => $r->nombre,            
            'fecha_evento_inicio' => $r->fecha,      
            'hora_evento_inicio' => $r->hora_inicio,
            'hora_evento_fin' => $r->hora_fin,
        ]);

        return redirect()->route('evento_index');
    }

}
