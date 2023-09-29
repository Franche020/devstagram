@extends('layouts.app')

@section('titulo')
    @if ($user->username === auth()->user()->username)
        Tu Cuenta
    @else
        @<?php echo $user->username ?>
    @endif
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
    
@endsection