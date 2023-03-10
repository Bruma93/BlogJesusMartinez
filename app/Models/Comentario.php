<?php

namespace App\Models;

use App\Models\Comentario as ModelsComentario;
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

     public function obtenerComentarioPorID($id){
         return Comentario::where('id', '=',$id)->get(); 
     }

     public function obtenerComentarioPorIdUser($user_id){
         return Comentario::where('user_id', '=',$user_id)->get(); 
     }

    /* public function obtenerComentariosPorIdProducto($product_id){
     // Where
        //return ModelsComentario::find($product_id); 
     }*/

   public function obtenerComentariosPorIdProducto($product_id){
        return Comentario::where('product_id', '=',$product_id)->get(); 
     } 

    public function user(){
      return $this->belongsTo(User::class);
    }

    public function product(){
        return $this->belongsTo(Product::class);
    }

}
