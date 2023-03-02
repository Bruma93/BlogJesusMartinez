<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Comentario;



class ProductoController extends Controller
{
    public function index()
    {

        //laravel permite paginar
        $datos['productos'] = Product::paginate(100);
 
        return view('producto.index', $datos);
    }

    public function create()
    {
        $user = Auth::user();
        return view('producto.create', compact('user'));
    }


    public function store(Request $request)
    {   
        //validacion
        $campos = [
            'nombre' => 'required|string|max:250',
            'description' => 'required|string|max:1000',
            'quantity' => 'required|int|max:250',
            'status' => 'required|int|max:4',
            'seller_id' => 'required|int',
        ];

        //los mensajes de error
        $mensaje = [
            'required' => 'El campo :attribute es obligatorio',
            'nombre.required' => 'El nombre del producto es obligatorio',
            'description.required' => 'la descripción del producto es obligatoria',
            'quantity.required' => 'la cantidad del producto es obligatoria',
            'max' => 'El campo :atribute no puede ternetr mas de :max caracteres',
        ];

        $this->validate($request, $campos, $mensaje);
        $datosProductos = $request->except('_token');
        Product::insert($datosProductos);

        //return dd($datosProductos);
        return redirect('producto')->with('mensaje', 'Se ha creado un producto');

    }

    public function show($id)
    {
        $producto = Product::findOrFail($id);
        $objetoComentario = new Comentario();
        $comentarios = $objetoComentario->obtenerComentariosPorIdProducto($id);

        

        return view('producto.show', compact('producto','comentarios'));
    }

    public function edit($id)
    {
        $producto = Product::findOrFail($id);
        return view('producto.edit', compact('producto'));
    }

    public function update(Request $request, $id)
    {
    //validacion
    $campos = [
        'nombre' => 'required|string|max:250',
        'description' => 'required|string|max:1000',
        'quantity' => 'required|int|max:250',
        'status' => 'required|int',
        'seller_id' => 'required|int',
    ];

    //los mensajes de error
    $mensaje = [
        'required' => 'El campo :attribute es obligatorio',
        'nombre.required' => 'El nombre del producto es obligatorio',
        'description.required' => 'la descripción del producto es obligatoria',
        'quantity.required' => 'la cantidad del producto es obligatoria',
        'max' => 'El campo :atribute no puede ternetr mas de :max caracteres',
    ];

    $this->validate($request, $campos, $mensaje);

    $datosProducto = request()->except('_token', '_method');

    Product::where('id', '=', $id)->update($datosProducto);

        $producto = Product::findOrFail($id);

        return redirect('producto')->with('mensaje', 'Se ha modificiado los datos del producto '.$producto->nombre);
    }

    public function destroy($id)
    {
        $objetoComentario = new Comentario();
        $comentario = $objetoComentario->obtenerComentariosPorIdProducto($id);
        //dd($comentario);
        
        Comentario::destroy($comentario[0]->id);
        Product::destroy($id);
        
        return redirect('producto')->with('mensaje', 'Se ha eliminado el producto #' . $id);

    }

}
