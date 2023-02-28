@extends('layouts.app')

@section('content')
<div class="container">
    datos de producto
    <hr>
    {{ $producto->nombre }}
    <br>
    Descripción: {{ $producto->description }}
    <br>
    Cantidad: {{ $producto->quantity}}
    <br>
    Estado: {{ $producto->status}}
    <br>
    Id del vendendor: {{ $producto->seller_id}}
    <br>
    <a href="{{ url('producto') }}">volver</a>

</div>
@endsection