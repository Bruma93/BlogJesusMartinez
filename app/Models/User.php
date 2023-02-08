<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'id',
        'remember_token',
    ];

    public function obtenerUsuarios(){
        return User::All(); 
     }

     public function obtenerUsuarioPorID(){
        return User::find('id'); 
     }

     public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function comentarios()
    {
        return $this->hasMany(Comentario::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
