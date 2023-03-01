@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Editar datos del producto {{ $producto->id }}</h2>
    <form action="{{ url('/producto/' . $producto->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        @include('producto._fields', ['modo' => 'Editar'])

    </form>
</div>
@endsection