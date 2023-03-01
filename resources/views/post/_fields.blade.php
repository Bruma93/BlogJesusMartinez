@if(count($errors) > 0)
    <div class="alert alert-danger" role="alert">
        <ul>
        @foreach ($errors->all() as $error)
            <li>
                {{ $error }}
            </li>
        @endforeach
        </ul>
    </div>
@endif

<div class="form-group">
    <label for="nombre mb-3">Título</label>
    <input type="text" class="form-control" name="title" id="title" value="{{ isset($post->title) ? $post->title : old('title') }}">
</div>
<div class="form-group mb-3">
    <label for="status">Estado</label>
    <input type="text" class="form-control" name="status" id="status" value="{{ isset($post->status) ? $post->status : old('status') }}">
</div>
<div class="form-group mb-3">
    <label for="user_id">Id del usuario</label>
    <input type="number" class="form-control" name="user_id" id="user_id" value="{{ isset($post->user_id) ? $post->user_id : old('user_id') }}">
</div>
<div class="mt-5">
    <input type="submit" class="btn btn-primary me-3" value="{{ $modo }} post">
    <a class="btn btn-success" href="{{ url('post') }}" >volver</a>
</div>