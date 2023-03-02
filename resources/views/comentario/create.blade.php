@extends('layouts.app')

@section('content')
<div class="container">
    Formulario de creacion de comentarios
    <form action="{{ url('/comentario') }}" method="post" enctype="multipart/form-data">
        @csrf
       <!-- se incluye el formulario de la vista fields, se usara para crear y editar -->
        @include('comentario._fields', ['modo' => 'Crear'])

    </form>
</div>
@endsection