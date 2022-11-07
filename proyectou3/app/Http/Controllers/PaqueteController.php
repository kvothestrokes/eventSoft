<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Paquete;
use App\Models\Servicio;
use App\Models\Paqueteservicio;
use Illuminate\Support\Facades\Auth;

class PaqueteController extends Controller
{
    //
    public function listarPaquetes(){
        
        $paquetes = Paquete::all();
        $rol = "";
        if(Auth::user()){
            $rol = Auth::user()->rol;
        }

        //get services by paquete
        foreach($paquetes as $paquete){
            $services = Paqueteservicio::where('id_paquete', $paquete->id)->get();
            $paquete["services"] = $services;            
        }

        return view('paquetes', [
            'paquetes' => $paquetes,
            'rol' => $rol,
        ]);
    }

    public function crearPaquete(Request $request){
        $paquete = new Paquete();
        $paquete->nombre = $request->nombre;        
        $paquete->descripcion = $request->descripcion;             
        $paquete->precio = $request->precio;
        $paquete->imagen = $request->imagen;        

        $paquete->save();

        $newId = $paquete->id;

        //save services
        $services = $request->services;
        foreach($services as $service){
            $paqueteservicio = new Paqueteservicio();
            $paqueteservicio->paquete_id = $newId;
            $paqueteservicio->servicio_id = $service;
            $paqueteservicio->save();
        }

        return redirect()->route('paquetes');
    }

    public function eliminarPaquete($id){
        $paquete = Paquete::find($id);
        $paquete->delete();

        return redirect()->route('paquetes');
    }

    public function editarPaquete(Request $r ,Paquete $id){
        $paquete = Paquete::find($id);
        $paquete->update([
            'nombre' => $r->nombre,            
            'descripcion' => $r->descripcion,   
            'precio' => $r->precio,
            'imagen' => $r->imagen,
        ]);

        return view('paquetes');
    }

}
