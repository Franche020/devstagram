<?php

namespace App\Http\Controllers;

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
        return view('dashborad', [
            'user' => $user
        ]);
    }
    public function create () 
    {
        return view('post.create');
    }

}
