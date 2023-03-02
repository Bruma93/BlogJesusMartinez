<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $hidden = ['id'] ;

    protected $fillable = ['user_id', 'title', 'status'];

    protected $cast = [
        'user_id' => 'integer',
    ];

    public function obtenerPosts(){
        return Post::All(); 
     }

     public function obtenerPostsPorID($id){
        return Post::where('id', '=' ,$id)->get();
     }

     public function obtenerPostPorIdUser($user_id){
        return Post::where('user_id', '=',$user_id)->get();
     }

     // Obtener el usuario al que peretence este post
    public function user(){
        return $this->belongsTo(User::class);
    }

}
