<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class ProductoController extends Controller
{
    public function index()
    {

        //laravel permite paginar
        $datos['productos'] = Product::paginate();
 
        return view('producto.index', $datos);
    }

    public function create()
    {
        return view('producto.create');
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

        return view('producto.show', compact('producto'));
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

    $datosProducto = request()->except('_token', '_method');

    Product::where('id', '=', $id)->update($datosProducto);

        $producto = Product::findOrFail($id);

        return view('producto.edit', compact('producto'));
        return redirect('producto')->with('mensaje', 'Se ha modificiado los datos del producto '.$datosProducto['nombre']);
    }

    public function destroy($id)
    {
        Product::destroy($id);
        
        return redirect('producto')->with('mensaje', 'Se ha eliminado el producto #' . $id);

    }

}