@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Datos del post</h2>
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