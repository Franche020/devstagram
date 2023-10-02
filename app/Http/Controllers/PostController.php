<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    //Index del muro donde aparecen los post
    public function index (User $user)
    {   
        $posts = Post::where('user_id' , $user->id);
        // pagina principal del usuario con su informacion y post
        return view('dashborad', [
            'user' => $user
        ]);
    }
    // Creacion de los post
    public function create () 
    {
        return view('post.create');
    }
    //Almacenamiento de los post
    public function store (Request $request)
    {
        $this->validate($request, [
            'titulo' => 'required|max:255',
            'descripcion' =>'required',
            'imagen' => 'required'
        ]);

        //TODO SI al cabo de un rato el post no se ha creado, borrar la imagen

        // Post::create([
        //     'titulo' => $request->titulo,
        //     'descripcion' => $request->descripcion,
        //     'imagen' => $request->imagen,
        //     'user_id' => auth()->user()->id
        // ]);

        // otra forma

        // $post = new Post;
        // $post->titulo = $request->titulo;
        // $post->descripcion = $request->descripcion;
        // $post->imagen = $request->imagen;
        // $post->user_id = auth()->user()->id;

        // $post->save();

        // Tercera forma

        $request->user()->posts()->create([
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
            'imagen' => $request->imagen,
            'user_id' => auth()->user()->id
        ]);

        return redirect()->route('post.index', auth()->user()->username);   
    }
}

