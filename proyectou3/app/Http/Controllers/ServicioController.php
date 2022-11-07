<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Servicio;

class ServicioController extends Controller
{
    //
    public function listarServicios(){
        $servicios = Servicio::all();
        return view('servicios', compact('servicios'));
    }

    public function crearServicio(Request $request){
        $servicio = new Servicio();
        $servicio->nombre = $request->nombre;        
        $servicio->descripcion = $request->descripcion;             
        $servicio->precio = $request->precio;

        $servicio->save();

        return redirect()->route('servicios');
    }

    public function eliminarServicio($id){
        $servicio = Servicio::find($id);
        $servicio->delete();

        return redirect()->route('servicios');
    }

    public function editarServicio(Request $r ,Servicio $id){
        $servicio = Servicio::find($id);
        $servicio->update([
            'nombre' => $r->nombre,            
            'descripcion' => $r->descripcion,   
            'precio' => $r->precio,
        ]);

        return view('servicios');
    }

}
