<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;

class PerfilController extends Controller
{
    public function __construct()
    {
        $this->middleware("auth");
    }
    //Aqui se muestra la configuracion del perfil
    public function index(User $user)
    {
        return view("perfil.index");
    }
    // Aquí se actualiza el usuario
    public function store(Request $request)
    {
        //dd($request);
        // Validacion del formulario
        $this->validate($request, [
            'username' => ["required","alpha_dash","unique:users,username,".auth()->user()->id,"min:3","max:20", "not_in:editar-perfil,login,register"],
            'email'=> ["required","email","unique:users,email,".auth()->user()->id, "max:60" ],
            'password' => "confirmed|min:6|max:15|nullable",
            'old_password' => "required_with:password"
        ]);

        // Almacemiento de la imagen
        if($request->imagen){
           $nombreImagen = UserImagenController::store($request);
           UserImagenController::delete(auth()->user()->imagen);
        }
        
        // Obtencion del usuario para actualizar sus datos
        $user = User::find(auth()->user()->id); 
        
        // Comprobacion de la contraseña
        if (!empty($request->password)) {
            if (!Hash::check($request->old_password, auth()->user()->password)) {
                return back()->withErrors(["old_password"=>"Credenciales Incorrectas"]);
            }
            $user->password = Hash::make($request->password);
        }


        // Guardado del usuario
        $user->username = $request->username;
        $user->email = $request->email;
        // Comprueba si hay nueva imagen, si no comprueba si hay antigua y si no null
        $user->imagen = $nombreImagen ?? auth()->user()->imagen ?? null;
        $user->save();


        return redirect()->route('post.index', $user->username);
    }


    // TODO eliminar la imagen anterior
}
