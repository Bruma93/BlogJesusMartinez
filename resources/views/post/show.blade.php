@extends('layouts.app')

@section('content')
<div class="container">
    Datos del post
    <hr>
    {{ $post->title }}
    <br>
    Título: {{ $post->title }}
    <br>
    Estado: {{ $post->status }}
    <br>
    Id del usuario: {{ $post->user_id }}
    <br>
    <a href="{{ url('post') }}">volver</a>

</div>
@endsection