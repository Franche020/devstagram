@extends('layouts.app')

@section('titulo')
    {{ $post->titulo }}
@endsection

@section('contenido')
    <div class="container mx-auto md:flex">
        <div class="p-5 md:w-1/2">
            <img class="" src="{{ asset('uploads') . '/' . $post->imagen }}" alt="Imagen del post {{ $post->titulo }}">
            <div>
                @auth
                    <livewire:like-post :post="$post" />
                @endauth
            </div>
            <div>
                <a href="{{ route('post.index', $post->user->username) }}" class="font-bold">{{ $post->user->username }}</a>
                <p class="text-sm text-gray-500">{{ $post->created_at->diffForHumans() }}</p>
                <p class="mt-5">{{ $post->descripcion }}</p>
            </div>
            @auth
                @if ($post->user_id === auth()->user()->id)
                    <form action="{{ route('post.destroy', $post) }}" method="POST">
                        @method('DELETE')
                        @csrf
                        <input class="mt-4 cursor-pointer rounded bg-red-500 p-2 font-bold text-white hover:bg-red-600"
                            type="submit" value="Eliminar publicacion">
                    </form>
                @endif
            @endauth
        </div>

        <div class="p-5 md:w-1/2">
            <div class="mb-5 bg-white p-5 shadow">
                @auth

                    <p class="mb-4 text-center text-xl font-bold">Agrega un Nuevo Comentario</p>

                    @if (session('mensaje'))
                        <div class="mb-6 rounded-lg bg-green-500 p-2 text-center uppercase text-white">{{ session('mensaje') }}
                        </div>
                    @endif

                    <form action="{{ route('comentarios.store', [$user, $post]) }}" method="POST">
                        @csrf
                        <div class="mb-5">
                            <label for="comentario" class="mb-2 block font-bold uppercase text-gray-500">Añade
                                Comentario</label>
                            <textarea name="comentario" id="comentario" placeholder="Agrega un comentario"
                                class="@error('comentario') border-red-500 @enderror w-full rounded-lg border p-3"></textarea>
                            @error('comentario')
                                <p class="my-2 rounded-lg bg-red-500 p-2 text-center text-sm text-white">{{ $message }}</p>
                            @enderror
                        </div>
                        <input type="submit" value="Comentar"
                            class="w-full cursor-pointer rounded-lg bg-sky-600 p-3 font-bold uppercase text-white transition-colors hover:bg-sky-700">
                    </form>
                @endauth
            </div>
            <div class="mb-5 mt-10 max-h-80 overflow-y-scroll bg-white shadow">
                @if ($post->comentarios->count())
                    @foreach ($post->comentarios as $comentario)
                        <div class="border-b border-gray-300 p-5">
                            <p>{{ $comentario->comentario }}</p>
                            <div class="flex justify-between">
                                <p class="text-sm text-gray-500">{{ $comentario->updated_at->diffForHumans() }}</p>
                                <a class="text-sm"
                                    href="{{ route('post.index', $comentario->user->username) }}">@<?php echo $comentario->user->username; ?></a>
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
