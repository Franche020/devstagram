@extends('layouts.app')

@section('titulo')
    @auth
    Tu Cuenta
        
    @endauth
    @guest
    @<?php echo $user->username ?>
    @endguest

@endsection

@section('contenido')

    <div class="flex justify-center">
        <div class="w-full md:w-8/12 lg:w-6/12 flex flex-col items-center md:flex-row">
            <div class="w-8/12 lg:w-6/12 px-5">
                <img src="{{ asset('img/usuario.svg') }}" alt="imagen usuario default">
            </div>
            <div class="md:w-8/12 lg:w-6/12 px-5 flex flex-col items-center md:items-start md:justify-center py-10 md:py-10">
                <p class="text-gray-700 text-2xl">{{$user->username}}</p>
                <p class="text-gray-500 text-sm mb-3 mt-5 font-bold">
                    0
                    <span class="font-normal"> Segidores</span>
                </p>
                <p class="text-gray-500 text-sm mb-3 font-bold">
                    0
                    <span class="font-normal"> Siguiendo</span>
                </p>
                <p class="text-gray-500 text-sm mb-3 font-bold">
                    0
                    <span class="font-normal"> Posts</span>
                </p>
            </div>

        </div>
    </div>

    <section class="container mx-auto mt-10">
        <h2 class="text-4xl text-center font-black my-10">Publicaciones</h2>

        @if ($posts->count())
        <div class="grid md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 mx-5">
            @foreach ($posts as $post)
                <div>
                    <a href="{{ route('posts.show', ['user' => $user , 'post' =>$post])}}">
                        <img src="{{asset('uploads') . '/' . $post->imagen}}" alt=" Imagen del post {{$post->titulo}}">
                    </a>
                </div>
                @endforeach
        </div>

        <div>
            {{$posts->links('pagination::tailwind')}}
        </div>
            
        @else
            <p class="text-gray-600 uppercase text-sm text-center font-bold">No hay Posts</p>
        @endif

    </section>
    
@endsection

