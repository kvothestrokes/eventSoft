<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Paquete;
use App\Models\Paqueteservicio;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $paquetes = Paquete::all();

        //get services by paquete
        foreach($paquetes as $paquete){
            $services = Paqueteservicio::where('id', $paquete->id)->get();
            $paquete["services"] = $services;            
        }

        //get user rol
        $user = Auth::user();


        return view('paquetes', [
            'paquetes' => $paquetes,
            'user'     => $user,
        ]);

    }
}
