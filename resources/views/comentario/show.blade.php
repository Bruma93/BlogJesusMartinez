@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Datos del comentario</h2>
    <hr>
    {{ $comentario->title }}
    <br>
    Texto: {{ $comentario->comentario }}
    <br>
    Id del usuario: {{ $comentario->user_id }}
    <br>
    Id del producto: {{ $comentario->product_id }}
    <br>
    <a href="{{ url('comentario') }}">volver</a>

</div>
@endsection