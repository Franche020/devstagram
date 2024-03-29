@extends('layouts.app')

@section('titulo')
    @auth
        @if ($user->id === auth()->user()->id)
            Tu Cuenta
        @else
            @<?php echo $user->username; ?>
        @endif
    @endauth
    @guest
        @<?php echo $user->username; ?>
    @endguest
@endsection

@section('contenido')
    <div class="flex justify-center">
        <div class="flex w-full flex-col items-center md:w-8/12 md:flex-row lg:w-6/12">
            <div class="w-8/12 px-5 lg:w-6/12">
                <img src="{{ $user->imagen ? asset('userimg') . '/' . $user->imagen : asset('img/usuario.svg') }}"
                    alt="imagen usuario default">
            </div>
            <div class="flex flex-col items-center px-5 py-10 md:w-8/12 md:items-start md:justify-center md:py-10 lg:w-6/12">
                <div class="flex items-center gap-2">
                    <p class="text-2xl text-gray-700">{{ $user->username }}</p>
                    @auth
                        @if ($user->id === auth()->user()->id)
                            <a href="{{ route('perfil.index') }}" class="cursor-pointer text-gray-500 hover:text-gray-600">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="h-6 w-6">
                                    <path
                                        d="M21.731 2.269a2.625 2.625 0 00-3.712 0l-1.157 1.157 3.712 3.712 1.157-1.157a2.625 2.625 0 000-3.712zM19.513 8.199l-3.712-3.712-12.15 12.15a5.25 5.25 0 00-1.32 2.214l-.8 2.685a.75.75 0 00.933.933l2.685-.8a5.25 5.25 0 002.214-1.32L19.513 8.2z" />
                                </svg>
                            </a>
                        @endif
                    @endauth
                </div>
                <p class="mb-3 mt-5 text-sm font-bold text-gray-500">
                    {{ $user->followers->count() }}
                    <span class="font-normal"> @choice('Seguidor|Seguidores', $user->followers->count())</span>
                </p>
                <p class="mb-3 text-sm font-bold text-gray-500">
                    {{ $user->following->count() }}
                    <span class="font-normal"> Siguiendo</span>
                </p>
                <p class="mb-3 text-sm font-bold text-gray-500">
                    {{ $user->posts()->count() }}
                    <span class="font-normal"> Posts</span>
                </p>
                @auth
                    @if ($user->id !== auth()->user()->id)
                        @if (!$user->siguiendo(auth()->user()))
                            <form action="{{ route('users.follow', $user) }}" method="POST">
                                @csrf
                                <input
                                    class="cursor-pointer rounded-lg bg-blue-600 px-3 py-1 text-xs font-bold uppercase text-white"
                                    type="submit" value="Seguir">
                            </form>
                        @else
                            <form action="{{ route('users.unfollow', $user) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <input
                                    class="cursor-pointer rounded-lg bg-red-600 px-3 py-1 text-xs font-bold uppercase text-white"
                                    type="submit" value="Dejar de seguir">
                            </form>
                        @endif
                    @endif
                @endauth
            </div>

        </div>
    </div>

    <section class="container mx-auto mt-10">
        <h2 class="my-10 text-center text-4xl font-black">Publicaciones</h2>
        
        <x-listar-post :posts="$posts" />

    </section>
@endsection
