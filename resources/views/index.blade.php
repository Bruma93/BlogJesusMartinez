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

    <!-- Aquie debo de empezar a hacer diseños to guapos-->
    <a href="{{ url('producto/create') }}" class="btn btn-info">Registrar Producto</a>
    <hr>
   
    {!! $productos->links() !!}

</div>
@endsection

@section('datatable')
<script>
    $(document).ready( function () {
        $('.data-table').DataTable({

        });
    } );
</script>
@endsection