<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comentario;
use Illuminate\Support\Facades\Auth;


class ComentarioController extends Controller
{
    public function index()
    {
        //laravel permite paginar
        $datos['comentarios'] = Comentario::paginate(100);
 
        return view('comentario.index', $datos);
    }

    public function create()
    {
        $user= Auth::user();
        return view('comentario.create', compact('user'));
    }

    public function store(Request $request)
    {
        //validacion
        $campos = [
            'user_id' => 'required|int',
            'product_id' => 'required|int',
            'comentario' => 'required|string',
        ];

        //los mensajes de error
        $mensaje = [
            'required' => 'El campo :attribute es obligatorio',
        ];

        $this->validate($request, $campos, $mensaje);
        $datosComentario = $request->except('_token');
        Comentario::insert($datosComentario);

        //return dd($datosProductos);
        return redirect('producto')->with('mensaje', 'Se ha creado un comentario');
    }

 
    public function show($id)
    {
        $comentario = Comentario::findOrFail($id);

        return view('comentario.show', compact('comentario'));
    }


    public function edit($id)
    {
        $comentario = Comentario::findOrFail($id);

        return view('comentario.edit', compact('comentario'));
    }

    public function update(Request $request, $id)
    {
       //validacion
       $campos = [
        'user_id' => 'required|int',
        'product_id' => 'required|int',
        'comentario' => 'required|string',
        ];

        //los mensajes de error
        $mensaje = [
            'required' => 'El campo :attribute es obligatorio',
        ];

        $this->validate($request, $campos, $mensaje);

        $datosComentario = request()->except('_token', '_method');

        Comentario::where('id', '=', $id)->update($datosComentario);

        $comentario = Comentario::findOrFail($id);

        return redirect('producto/'.$comentario->product_id)->with('mensaje', 'Se ha modificiado los datos del comentario '.$comentario->id);
    
    }

    public function destroy($id)
    {
        $comentario = Comentario::findOrFail($id);
        Comentario::destroy($id);
        
        return redirect('producto/'.$comentario->product_id)->with('mensaje', 'Se ha eliminado el producto #' . $id);
    }
}
