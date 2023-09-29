<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    // Vista inicial, landing
    public function index()
    {
        return view("auth.register");
    }
    // Almacenamiento de los usuarios
    public function store(Request $request)
    {
        //dd($request);
        //dd($request->get('username'));
        
        // Validacion
        $this->validate($request, [
            "name" => "required|max:30",
            "username" => "required|alpha_dash|unique:users|min:3|max:20",
            "email" => "required|unique:users|email|max:60",
            "password" => "required|confirmed|",
        ]);
        
        // Almacenamiento en la DB
        User::create([
            "name" => $request->name,
            "username" => Str::slug($request->username),
            "email" => $request->email,
            "password" => $request->password,
        ]);

        // Autenticar al usuario

        // auth()->attempt([
        //     'email' => $request->email,
        //     'password' => $request->password
        // ]);

        // Otra forma de autenticar
        auth()->attempt($request->only('email','password'));

        

        //redireccionar
        return redirect()->route('post.index',auth()->user()->username);
    }
}
