@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Editar datos del comentario {{ $comentario->id }}</h2>
    <form action="{{ url('/comentario/' . $comentario->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        @include('comentario._fields', ['modo' => 'Editar'])

    </form>
</div>
@endsection