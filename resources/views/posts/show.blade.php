@extends('layouts.app')

@section('titulo')
    {{ $post->titulo }}
@endsection

@section('contenido')
    <div class="container mx-auto md:flex">
        <div class="md:w-1/2 p-5">
            <img class="" src="{{ asset('uploads') . '/' . $post->imagen }}" alt="Imagen del post {{ $post->titulo }}">
            <div class="p-3">
                <p>0 Likes</p>
            </div>
            <div>
                <a href="{{route('post.index', $post->user->username)}}" class="font-bold">{{ $post->user->username }}</a>
                <p class="text-sm text-gray-500">{{ $post->created_at->diffForHumans() }}</p>
                <p class="mt-5">{{ $post->descripcion }}</p>
            </div>
            @auth
                @if ($post->user_id === auth()->user()->id)
                <form action="{{route('post.destroy', $post)}}" method="POST">
                    @method('DELETE')
                    @csrf
                    <input class="bg-red-500 hover:bg-red-600 p-2 rounded text-white font-bold mt-4 cursor-pointer" type="submit" value="Eliminar publicacion">
                </form>
                    
                @endif
            @endauth
        </div>

        <div class="md:w-1/2 p-5">
            <div class="shadow bg-white p-5 mb-5">
                @auth

                    <p class="text-xl font-bold text-center mb-4">Agrega un Nuevo Comentario</p>

                    @if(session('mensaje'))
                        <div class="bg-green-500 p-2 rounded-lg mb-6 text-white text-center uppercase">{{session('mensaje')}}</div>
                    @endif

                    <form action="{{route('comentarios.store', [$user, $post])}}" method="POST">
                        @csrf
                        <div class="mb-5">
                            <label for="comentario" class="mb-2 block uppercase text-gray-500 font-bold">Añade
                                Comentario</label>
                            <textarea name="comentario" id="comentario" placeholder="Agrega un comentario"
                                class="border p-3 w-full rounded-lg 
                        @error('comentario') border-red-500 @enderror"></textarea>
                            @error('comentario')
                                <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>
                            @enderror
                        </div>
                        <input type="submit" value="Comentar"
                            class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg">
                    </form>
                @endauth
            </div>
            <div class="bg-white shadow mb-5 max-h-80 overflow-y-scroll mt-10">
                @if ($post->comentarios->count())
                    @foreach ($post->comentarios as $comentario)
                        <div class="p-5 border-gray-300 border-b">
                            <p>{{$comentario->comentario}}</p>
                            <div class="flex justify-between">
                                <p class="text-sm text-gray-500">{{$comentario->updated_at->diffForHumans()}}</p>
                                <a class="text-sm" href="{{route('post.index', $comentario->user->username)}}" >@<?php echo $comentario->user->username; ?></a>
                            </div>
                        </div>
                    @endforeach
                @else
                    <p class="p-10 text-center">No hay comentarios</p>
                @endif
            </div>
        </div>

    </div>
@endsection
