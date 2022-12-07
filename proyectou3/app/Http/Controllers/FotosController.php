<?php

namespace App\Http\Controllers;
use App\Models\Fotos;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class FotosController extends Controller
{
    //add foto
    public function addFoto(Request $request){
        $foto = new Fotos();
        $foto->descripcion = $request->descripcion;        
        $fileImage = $request->file('imagen');     
        $foto->imagen = base64_encode(file_get_contents($fileImage));
        $foto->id_evento = $request->id_evento;
        $foto->creado_por = Auth::user()->id;
        $foto->save();
        return redirect()->back();
    }

    //delete foto
    public function deleteFoto($id){        
        $foto = Fotos::find($id);

        // si se borro por el mismo usuario que lo creo
        if($foto->creado_por == Auth::user()->id){            
            $foto->delete();
        }
        
        return redirect()->back();
    }

    //edit foto
    public function editFoto(Request $request){
        $foto = Fotos::find($request->id);            
        // dd($request);
        $foto->descripcion = $request->descripcion;               
        $foto->save();
        return redirect()->back();
    }

}
