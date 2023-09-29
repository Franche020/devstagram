<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    // Index para logeo
    public function index ()
    {
        // Generacion de la vista
        return view('auth.login');
    }

    // Procesado del POST
    public function store (Request $request)
    {   

        // Validacion del request
        $this->validate($request, [
            'email' => 'email|required',
            'password' => 'required'
        ]);
        // Logar al usuario una vez la validacion pase
        if(!auth()->attempt($request->only('email','password'),$request->remember)) {
            return back()->with('mensaje', 'Credenciales Incorrectas');
        }
        // Redireccionar al muro
        return redirect()->route('post.index', auth()->user()->username);
    }
}
