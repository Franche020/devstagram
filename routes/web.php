<?php

use App\Http\Controllers\FollowerController;
use App\Http\Controllers\PerfilController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ImagenController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ComentarioController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('/', function(){
    return view('principal');
});

// Registro
Route::get('/register', [RegisterController::class , 'index'])->name('register');
Route::post('/register', [RegisterController::class , 'store']);

// Login
Route::get('/login', [LoginController::class , 'index'])->name('login');
Route::post('/login', [LoginController::class , 'store']);
Route::post('/logout', [LogoutController::class, 'store'])->name('logout');


// Rutas para el perfil
Route::get('/editar-perfil', [PerfilController::class,'index'])->name('perfil.index');
Route::post('/editar-perfil', [PerfilController::class,'store'])->name('perfil.store');

// Gestion de post
Route::get('/posts/create', [PostController::class, 'create'])->name('post.create');
Route::post('/posts/store', [PostController::class, 'store'])->name('post.store');
Route::get('/{user:username}/posts/{post}', [PostController::class, 'show'])->name('posts.show');
Route::delete('post/{post}', [PostController::class, 'destroy'])->name('post.destroy');

// Almacenamiento comentarios
Route::post('/{user:username}/posts/{post}', [ComentarioController::class, 'store'])->name('comentarios.store');

// Almacenamiento imagenes
Route::post('/imagenes', [ImagenController::class, 'store'])->name('imagenes.store');

// Likes fotos
Route::post('/posts/{post}/likes', [LikeController::class,'store'])->name('post.likes.store');
Route::delete('/posts/{post}/likes', [LikeController::class,'destroy'])->name('post.likes.destroy');

// Siguiendo usuarios
Route::post('/{user:username}/follow', [FollowerController::class, 'store'])->name('users.follow');
Route::delete('/{user:username}/unfollow', [FollowerController::class, 'destroy'])->name('users.unfollow');

// Dashboard
    //* ESTA RUTA HA DE ESTAR AL FINAL PARA EVITAR ERRORES DE ENRUTADO
Route::get('/{user:username}', [PostController::class,'index'])->name('post.index');