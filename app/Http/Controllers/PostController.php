<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use App\Models\Comentario;


class PostController extends Controller
{
    public function index()
    {

        //laravel permite paginar
        $datos['posts'] = Post::paginate(20);
 
        return view('post.index', $datos);
    }

    public function create()
    {
        return view('post.create');
    }

    public function store(Request $request)
    {   
        //validacion
        $campos = [
            'title' => 'required|string|max:250',
            'status' => 'required|string|max:250',
            'user_id' => 'required|int',
        ];

        //los mensajes de error
        $mensaje = [
            'required' => 'El campo :attribute es obligatorio',
            'max' => 'El campo :atribute no puede ternetr mas de :max caracteres',
        ];

        $this->validate($request, $campos, $mensaje);
        $datosPost = $request->except('_token');
        Post::insert($datosPost);

        //return dd($datosProductos);
        return redirect('post')->with('mensaje', 'Se ha creado un post');

    }

    public function show($id)
    {
        $post = Post::findOrFail($id);

        return view('post.show', compact('post'));
    }

    public function edit($id)
    {
        $post = Post::findOrFail($id);

        return view('post.edit', compact('post'));
    }

    public function update(Request $request, $id)
    {
        //validacion
        $campos = [
            'title' => 'required|string|max:250',
            'status' => 'required|string|max:250',
            'user_id' => 'required|int',
        ];

        //los mensajes de error
        $mensaje = [
            'required' => 'El campo :attribute es obligatorio',
            'max' => 'El campo :atribute no puede ternetr mas de :max caracteres',
        ];

    $this->validate($request, $campos, $mensaje);

    $datosPost = request()->except('_token', '_method');

    Post::where('id', '=', $id)->update($datosPost);

        $post = Post::findOrFail($id);

        return view('post.edit', compact('post'));
        return redirect('post')->with('mensaje', 'Se ha modificiado los datos del producto '.$datosPost['nombre']);
    }
    

    public function destroy($id)
    {
        $objetoComentario = new Comentario();
        $comentario = $objetoComentario->obtenerComentariosPorIdProducto($id);
        //dd($comentario);
        
        Comentario::destroy($comentario[0]->id);
        Post::destroy($id);
        
        return redirect('post')->with('mensaje', 'Se ha eliminado el producto #' . $id);
    }
}
