<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Servicio;

class ServicioController extends Controller
{
    //
    public function index(){
        $servicios = Servicio::all();
        return view('admin.services_list', compact('servicios'));
    }


    public function newUser(){
        return view('admin.servicios_create');
    }

    public function crearServicio(Request $request){
        $servicio = new Servicio();
        $servicio->nombre = $request->nombre;        
        $servicio->descripcion = $request->descripcion;             
        $servicio->precio = $request->precio;

        $servicio->save();

        return redirect()->route('servicios_index');
    }

    public function eliminarServicio($id){
        $servicio = Servicio::find($id);
        $servicio->delete();

        return redirect()->route('servicios_index');
    }


    public function editServicio($id){
        $servicio = Servicio::find($id);
        return view('admin.servicios_edit', compact('servicio'));
    }

    public function editarServicios(Request $r ,Servicio $id){
        $servicio = Servicio::find($id)[0];
        $servicio->nombre = $r->nombre;
        $servicio->descripcion = $r->descripcion;
        $servicio->precio = $r->precio;

        $servicio->save();

        return redirect()->route('servicios_index');
    }

}
