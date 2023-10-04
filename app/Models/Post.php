<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'titulo',
        'descripcion',
        'imagen',
        'user_id',
    ];

        /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
    ];


    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    // protected $casts = [
    //     'email_verified_at' => 'datetime',
    //     'password' => 'hashed',
    // ];

    // Retorna el usuario al que el post instanciado pertenece
    public function user ()
    {
        return $this->belongsTo(User::class)->select(['name','username']);
    }  

    public function comentarios () {
        return $this->hasMany(Comentario::class);
    }
}
