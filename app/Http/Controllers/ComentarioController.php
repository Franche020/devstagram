<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ComentarioController extends Controller
{
    //Almacenamiento de los comentarios
    public function store(Request $request)
    {
        // validar
        $this->validate($request, [

        ]);
        // almacenar

        // imprimir confirmacion
    }
}
