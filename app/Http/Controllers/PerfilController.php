<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class PerfilController extends Controller
{
    public function __construct()
    {
        $this->middleware("auth");
    }
    //Aqui se muestra la configuracion del perfil
    public function index(User $user)
    {

        if (!Gate::allows("perfil-edit", [
            'perfil'=>$user
        ])) {
            abort(403);
        }
        return view("perfil.index");
    }
}
