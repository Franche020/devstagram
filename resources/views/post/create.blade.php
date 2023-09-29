@extends('layouts.app')

@section('titulo')
    Crear una nueva publicación
@endsection
@push('styles')
<link rel="stylesheet" href="{{ asset('css/dropzone.min.css') }}" type="text/css" />
@endpush

@section('contenido')
    <div class="md:flex md:items-center">
        <div class="md:w-1/2 px-10">
            <form class="dropzone border-dashed border-2 w-full h-96 rounded flex flex-col justify-center items-center" action="{{route('imagenes.store')}}" method="POST" enctype="multipart/form-data" id="dropzone">
                @csrf
            </form>
        </div>
        <div class="md:w-1/2 p-10 mt-10 mx-5 sm:mx-0 md:mx-2 md:mt-0 bg-white rounded-xl shadow-xl">
            <form action="{{ route('register') }}" method="POST" novalidate>
                @csrf
                <div class="mb-5">
                    <label for="titulo" class="mb-2 block uppercase text-gray-500 font-bold">Título</label>
                    <input type="text" name="titulo" id="titulo" placeholder="Título de la Publicación"
                        class="border p-3 w-full rounded-lg @error('titulo')
                        border-red-500
                    @enderror"
                        value="{{ old('titulo') }}">
                    @error('titulo')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-5">
                    <label for="descripcion" class="mb-2 block uppercase text-gray-500 font-bold">Descripción</label>
                    <textarea name="descripcion" id="descripcion" placeholder="Descripción de la Publicación"
                        class="border p-3 w-full rounded-lg 
                        @error('descripcion') border-red-500 @enderror">{{ old('descripcion') }}</textarea>
                    @error('descripcion')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>
                    @enderror
                </div>
                <input type="submit" value="Publicar"
                class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg">

            </form>
        </div>

    </div>
@endsection
