@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Datos de producto</h2>
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
    Comentarios:
    <table class="table data-table text-white">
        <thead>
            <tr>
                <th>#</th>
                <th>Comentario</th>
                <th>Id del usuario</th>
                <th>Id del producto</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($comentarios as $comentario)
            <tr>
                <td>{{$comentario->id }}</td>
                <td>{{$comentario->comentario}}</td>
                <td>{{$comentario->user_id}}</td>
                <td>{{$comentario->product_id}}</td>
                <td>
                    <div class="d-flex" role="group">
                        <a href="{{ url('comentario/' . $comentario->id) }}" class="btn btn-primary me-3">Ver</a>
                        <a href="{{ url('comentario/' . $comentario->id . '/edit') }}" class="btn btn-warning me-3">Editar</a>
                        <form action="{{url('comentario/' . $comentario->id) }}" method="post">
                            @csrf
                            {{ method_field('DELETE') }}
                            <input type="submit" onclick="return confirm('se va a elmiminar el registro #{{ $comentario->id}}')" class="btn btn-danger" value="Borrar">
                        </form>
                    </div>
                </td>
            </tr>
            @endforeach
            
        </tbody>
    </table>
    <a href="{{ url('producto') }}" class="btn btn-primary me-3">volver</a>
    <a href="{{ url('comentario/create') }}" class="btn btn-info">Registrar Comentario</a>


</div>
@endsection

@section('datatable')
<script>
    $(document).ready(function () {
    $('.data-table').DataTable();
});
</script>