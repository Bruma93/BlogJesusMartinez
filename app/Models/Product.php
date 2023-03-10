<?php

namespace App\Models;

use App\Models\Product as ModelsProduct;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    use HasFactory;

    protected $hidden = ['id'] ;

    protected $fillable = ['nombre', 'description', 'quantity','status','seller_id'];

    protected $cast = [
        'quantity' => 'integer',
        'status' => 'integer',
        'seller_id' => 'integer'
    ];

    public function obtenerProductos(){
        return Product::All(); 
     }

     public function obtenerProductoPorID($id){
      return Product::where('id', '=',$id)->get();
     }

     public function obtenerProductoPorIdVendedor($seller_id){
      return Product::where('seller_id', '=',$seller_id)->get();
     }

     public function user(){
        return $this->belongsTo(User::class);
      }

      public function comentario(){
         return $this->hasMany(Comentario::class);
      }
}
