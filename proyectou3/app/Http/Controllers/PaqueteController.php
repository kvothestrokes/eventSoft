<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Paquete;
use App\Models\Servicio;
use App\Models\Paqueteservicio;
use App\Models\Evento;
use Hamcrest\Type\IsObject;
use Illuminate\Support\Facades\Auth;

use function PHPUnit\Framework\isNull;

class PaqueteController extends Controller
{
    //
    public function listarPaquetes(){
        
        $paquetes = Paquete::all();
        $rol = "";

        try {
            if(is_object(Auth::user())){
                $rol = Auth::user()->rol;
            }    
        } catch (\Throwable $th) {
            //throw $th;
        }

        if($rol == "vendedor"){            
            return redirect()->route('evento_empleado');
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
        $services = Servicio::all();
        $paqueteServicio = Paqueteservicio::where('id_paquete', $p)->get();

        $serviciosEnPaquete = [];
        foreach($paqueteServicio as $ps){
            $serviciosEnPaquete[] = $ps->id_servicio;
        }        

        $paquete = Paquete::find($p);        
        return view('admin.paquetes_edit', [
            'paquete' => $paquete,            
            'services' => $services,
            'serviciosEnPaquete' => $serviciosEnPaquete,
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
        
        $newId = $paquete->id;
        
        // save services
        $services = $request->servicios;        
        if (!is_null($services)) {            
            foreach($services as $service){
                $paqueteservicio = new Paqueteservicio();
                $paqueteservicio->id_paquete = $newId;
                $paqueteservicio->id_servicio = $service;
                $paqueteservicio->save();
            }
        }

        

        return redirect()->route('paquetes_index');
    }

    public function destroyPaquete($id){

        $paquete = Paquete::find($id);

        //Si el paquete es parte de un evento no confirmado        
        $evento = Evento::where('id_paquete', $paquete->id)->where('estado', "!=", "aceptado")->get();        

        if(!isNull($evento)){
            return redirect()->route('paquetes_index');
        }

        $paqueteServicio = Paqueteservicio::where('id_paquete', $paquete->id)->get();
        foreach($paqueteServicio as $ps){
            $ps->delete();
        }
       
        $paquete->delete();

        return redirect()->route('paquetes_index');
    }

    public function editarPaquete(Request $r){
        $paquete = Paquete::find($r->id);  
        
        //Si el paquete es parte de un evento no confirmado
        $evento = Evento::where('id_paquete', $r->id)->where('estado', "!=", "aceptado")->get();

        if(!isNull($evento)){
            return redirect()->route('paquetes_index');
        }


        //delete services
        $paqueteServicio = Paqueteservicio::where('id_paquete', $r->id)->get();
        foreach($paqueteServicio as $ps){
            $ps->delete();
        }

        //save services
        $services = $r->servicios;        
        foreach($services as $service){
            $paqueteservicio = new Paqueteservicio();
            $paqueteservicio->id_paquete = $paquete->id;
            $paqueteservicio->id_servicio = $service;
            $paqueteservicio->save();
        }

        $fileImage = $r->file('imagen');        
        $paquete->update([
            'nombre' => $r->name,            
            'descripcion' => $r->desc,   
            'precio' => $r->precio,            
            'imagen' => $fileImage=="" ? $paquete->imagen : base64_encode(file_get_contents($fileImage)),
        ]);

        return redirect()->route('paquetes_index');
    }

}
