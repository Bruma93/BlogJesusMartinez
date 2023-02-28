@extends('layouts.app')

@section('content')
<div class="container">
    formulario de creacion de productos
    <form action="{{ url('/producto') }}" method="post" enctype="multipart/form-data">
        @csrf
       <!-- se incluye el formulario de la vista fields, se usara para crear y editar -->
        @include('producto._fields', ['modo' => 'Crear'])

    </form>
</div>
@endsection
{{--
{{ $name }} <!-- llamar a una variable -->
env("APP_NAME") <!-- llamar a variable de entorno -->
{{ config('app.name') }}<!-- llamar a la variable name que se encuentra en config/app.php -->
{{ time() }}
{!! $name !!}<!-- Imprimir un valor sin escapar los caracteres especiales con htmlspecualchars -->
@{{ $name }} <!-- Imprime literalmente {{ name } }-->
@@if <!-- imprime @if --> 
@yield('content') <!-- En una plantilla Aparece el contenido de la seccion "content" -->
@extends('app')<!-- En la vista, importamos la plantilla app -->

<!-- Definir el contenido de content -->
@section('content')
<!-- Aqui va el contenido -->
@endsection
--}}