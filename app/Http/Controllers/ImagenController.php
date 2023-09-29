<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class ImagenController extends Controller
{
    //Almacenamiento de imagenes
    public function store (Request $request) 
    {
        // se crea el objeto UploadedFile al acceder al metodo file del request, este objeto trae intrinsecas unas serie de metodos que provienen de symphony
        $imagen = $request->file('file');

        // se crea un nombre unico para la imagen
        $nombreImagen = Str::uuid(). ".". $imagen->extension();

        // Creacion del objeto de intervention image
        $imagenServidor = Image::make($imagen);
        
        // Ajuste de imagen a 1000x1000 px
        $imagenServidor->fit(1000,1000);

        // Mover imagen al servidor
        $imagenPath = public_path('uploads') . '/' . $nombreImagen;
        // Comprobar la existencia del fichero
        if(!is_dir(public_path('uploads'))){
            mkdir('uploads');
        }
        // Guardar la imagen con intervention image
        $imagenServidor->save($imagenPath);
        
        // Con esto se responde encriptando en JSON el arreglo imagen con la extension de la imagen
        // return response()->json(['imagen'=> $imagen->extension()]);
        return response()->json(['imagen'=> $nombreImagen]);
        
    }
}
