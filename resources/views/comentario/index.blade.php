@extends('layouts.app')
@section('scripts')
    <link href="//cdn.datatables.net/1.13.2/css/jquery.dataTables.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script src="//cdn.datatables.net/1.13.2/js/jquery.dataTables.min.js" ></script>
    <script src=" //cdn.datatables.net/1.13.2/js/dataTables.bootstrap4.min.js"></script>

@endsection

@section('content')
<div class="container">
    @if (Session::has('mensaje'))
        <br>
        <div class="alert alert-success">
            {{ Session::get('mensaje') }}
        </div>
    @endif
    <div class="d-flex justify-content-between">
        <h2>Listado de Comentarios</h2>
        <div class="d-flex">
            <a href="{{ url('comentario/create') }}" class="btn btn-info me-3">Registrar Comentario</a>
            <a href="{{ url('producto') }}" class="btn btn-secondary me-3">Listado de Productos</a>
            <a href="{{ url('post') }}" class="btn btn-secondary">Listado de Posts</a>

        </div>
    </div>
    <hr>
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
    {!! $comentarios->links() !!}

</div>
@endsection

@section('datatable')
<script>
    $(document).ready(function () {
    $('.data-table').DataTable();
});
</script>
@endsection