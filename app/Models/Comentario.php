<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comentario extends Model
{
    use HasFactory;

    protected $hidden = ['id'] ;

    protected $fillable = ['user_id', 'product_id', 'comentario'];

    protected $cast = [
        'user_id' => 'integer',
        'product_id' => 'integer'
    ];

    public function obtenerComentarios(){
        return Comentario::All(); 
     }

     public function obtenerComentarioPorID(){
        return Comentario::find('id'); 
     }

     public function obtenerComentarioPorIdUser(){
        return Comentario::find('user_id'); 
     }

     public function obtenerComentariosPorIdProducto(){
        return Post::find('product_id'); 
     }

/*      public function obtenerComentariosPorIdProducto($product_id){
        return Comentario::where('product_id',$product_id)->get(); 
     } */

    public function user(){
      return $this->belongsTo(User::class);
    }

    public function product(){
        return $this->belongsTo(Product::class);
    }

}
