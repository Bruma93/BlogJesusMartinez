<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use JWTAuth;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class PostApiController extends Controller
{
    public function index(){
        return Post::get();

    }

    public function show($id){
        //Buscar al post
        $post = Post::find($id);

        //Si el epost no existe, devolvemos un error
        if(!$post){
            return response()->json([
                'message'=> 'post no encontrado'
            ], 404);
        }

        //Si hay post
        return $post;
    }

    public function store(Request $request){

        //validar  los datos
        $data = $request->only('title', 'status', 'user_id');

        $validator = Validator::make($data, [
            'title' => 'required|string|max:250',
            'status' => 'required|string|max:250',
            'user_id' => 'required|int',
        ]);

        //SI FALLA LA VALIDACION
        IF($validator->fails()){
            return response()->json(['error'=> $validator->messages()], 400);
        }

        $post = Post::create([
            'title'=> $request->title,
            'status'=> $request->status,
            'user_id'=> $request->user_id,
        ]);

        return response()->json([
            'message'=> 'post created',
            'data'=> $post
        ], Response::HTTP_OK);
    }

    public function update(request $request, $id){

        //validar datos
        $data = $request->only('title', 'status', 'user_id');

        $validator = Validator::make($data, [
            'title' => 'required|string|max:250',
            'status' => 'required|string|max:250',
            'user_id' => 'required|int',
        ]);

        //SI FALLA LA VALIDACION
        IF($validator->fails()){
            return response()->json(['error'=> $validator->messages()], 400);
        }

        //si falla la validación
        if($validator->fails()){
            return response()->json(['error'=>$validator->messages()]. 400);  
        }

        //Buscamos el post en base a la id
        $post = Post::findOrfail($id);
  
        $post->update($data);

        //Devolvemos los datos actualizados
        return response()->json([
            'message'=> 'post updates succefuly',
            'data'=> $post,
        
        ], Response::HTTP_OK);
    }

}
