<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use App\Models\Comentario;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function index()
    {
        //laravel permite paginar
        $datos['posts'] = Post::paginate(100);
 
        return view('post.index', $datos);
    }

    public function create()
    {   
        $user= Auth::user();
        return view('post.create', compact('user'));
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

        return redirect('post')->with('mensaje', 'Se ha modificiado los datos del producto '.$post->title);
    }
    

    public function destroy($id)
    {
        Post::destroy($id);
        
        return redirect('post')->with('mensaje', 'Se ha eliminado el producto #' . $id);
    }
}
