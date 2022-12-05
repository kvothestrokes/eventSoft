<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Evento;

class UserController extends Controller
{
    //
    public function index(){

        $users = User::all();

        return view('admin.user_list', [
            'users' => $users,
        ]);
    }

    public function editUsuario($id){

        $user = User::find($id);

        return view('admin.user_edit', [
            'user' => $user,
        ]);
    }

    public function editarUsuario(Request $request, $id){

        $user = User::find($id);        
        $user->name = $request->input('name');
        $user->email = $request->input('email');

        $pass = $request->input('password');
        if( $pass != null ){
            $user->password = bcrypt($pass);
        }

        $user->rol = $request->input('rol');

        $user->save();

        return redirect()->route('usuarios_index');
    }

    public function destroyUsuario($id){

        // si hay eventos no borrar
        $evento = Evento::where('id_usuario', $id)->first();
        if($evento != null){            
            return redirect()->route('usuarios_index')->with('error', 'No se puede eliminar el usuario porque tiene eventos asociados');
        }

        $user = User::find($id);
        $user->delete();

        return redirect()->route('usuarios_index');
    }

    public function createUsuario(){
        return view('admin.user_create');
    }

    public function storeUsuario(Request $request){

        $user = new User();

        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = bcrypt($request->input('password'));
        $user->rol = $request->input('rol');

        $user->save();

        return redirect()->route('usuarios_index');
    }

    public function panelAdmin(){
        return view('admin.panel');
    }

}
