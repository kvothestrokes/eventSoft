<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Paquete;
use App\Models\Servicio;
use App\Models\Paqueteservicio;
use App\Models\Evento;
use Illuminate\Support\Facades\Auth;

use function PHPUnit\Framework\isNull;

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

    public function createView(){
        $services = Servicio::all();
        return view('admin.paquetes_create', [
            'services' => $services,
        ]);
    }

    public function editPaquete($p){
        // $services = Servicio::all();

        $paquete = Paquete::find($p);        
        return view('admin.paquetes_edit', [
            'paquete' => $paquete,            
        ]);
    }

    public function crearPaquete(Request $request){
        $fileImage = $request->file('imagen');        
        $paquete = new Paquete();
        $paquete->nombre = $request->name;        
        $paquete->descripcion = $request->desc;             
        $paquete->precio = $request->precio;        
        $paquete->imagen = base64_encode(file_get_contents($fileImage));       

        $paquete->save();

        // $newId = $paquete->id;

        //save services
        // $services = $request->services;
        // foreach($services as $service){
        //     $paqueteservicio = new Paqueteservicio();
        //     $paqueteservicio->paquete_id = $newId;
        //     $paqueteservicio->servicio_id = $service;
        //     $paqueteservicio->save();
        // }

        return redirect()->route('paquetes_index');
    }

    public function destroyPaquete($id){

        $paquete = Paquete::find($id);

        //Si el paquete es parte de un evento no confirmado
        $evento = Evento::where('id_paquete', $paquete->id)->where('estado', "=", "no_confirmado")->get();

        if(!isNull($evento)){
            return redirect()->route('paquetes_index');
        }
       
        $paquete->delete();

        return redirect()->route('paquetes_index');
    }

    public function editarPaquete(Request $r){
        $paquete = Paquete::find($r->id);  
        
        //Si el paquete es parte de un evento no confirmado
        $evento = Evento::where('id_paquete', $r->id)->where('estado', "=", "no_confirmado")->get();

        if(!isNull($evento)){
            return redirect()->route('paquetes_index');
        }

        $fileImage = $r->file('imagen');        
        $paquete->update([
            'nombre' => $r->name,            
            'descripcion' => $r->desc,   
            'precio' => $r->precio,
            'imagen' => base64_encode(file_get_contents($fileImage)),
        ]);

        return redirect()->route('paquetes_index');
    }

}
