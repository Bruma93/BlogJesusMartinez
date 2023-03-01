@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Editar datos del post {{ $post->id }}</h2>
    <form action="{{ url('/post/' . $post->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        @include('post._fields', ['modo' => 'Editar'])

    </form>
</div>
@endsection