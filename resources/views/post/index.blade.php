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
        <h2>Listado de posts</h2>
        <a href="{{ url('post/create') }}" class="btn btn-info">Registrar Post</a>
    </div>
    <hr>
    <table class="table data-table text-white">
        <thead>
            <tr>
                <th>#</th>
                <th>Título</th>
                <th>Estado</th>
                <th>Id del usuario</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($posts as $post)
            <tr>
                <td>{{$post->id }}</td>
                <td>{{$post->title}}</td>
                <td>{{$post->status}}</td>
                <td>{{$post->user_id}}</td>
                <td>
                    <div class="d-flex" role="group">
                        <a href="{{ url('post/' . $post->id) }}" class="btn btn-primary me-3">ver</a>
                        <a href="{{ url('post/' . $post->id . '/edit') }}" class="btn btn-warning me-3">editar</a>
                        <form action="{{url('post/' . $post->id) }}" method="post">
                            @csrf
                            {{ method_field('DELETE') }}
                            <input type="submit" onclick="return confirm('se va a elmiminar el registro #{{ $post->id}}')" class="btn btn-danger" value="Borrar">
                        </form>
                    </div>
                </td>
            </tr>
            @endforeach
            
        </tbody>
    </table>
    <!-- {!! $posts->links() !!} -->

</div>
@endsection

@section('datatable')
<script>
    $(document).ready(function () {
    $('.data-table').DataTable();
});
</script>
@endsection