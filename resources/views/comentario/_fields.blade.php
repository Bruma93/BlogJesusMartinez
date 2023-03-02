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
    <label for="nombre mb-3">Comentario</label>
    <input type="text" class="form-control" name="comentario" id="comentario" value="{{ isset($comentario->comentario) ? $comentario->comentario : old('comentario') }}">
</div>
@if($modo == 'Crear')
    <input type="number" class="form-control" name="user_id" id="user_id" value="{{$user->id }}" hidden>
    <input type="number" class="form-control" name="product_id" id="product_id" value="2" hidden>
    @else
    <div class="form-group mb-3">
        <label for="user_id">Id del usuario</label>
        <input type="number" class="form-control" name="user_id" id="user_id" value="{{ isset($comentario->user_id) ? $comentario->user_id : old('user_id') }}">
    </div>
    <div class="form-group mb-3">
        <label for="user_id">Id del producto</label>
        <input type="number" class="form-control" name="product_id" id="product_id" value="{{ isset($comentario->product_id) ? $comentario->product_id : old('product_id') }}">
    </div>
@endif
<div class="mt-5">
    <input type="submit" class="btn btn-primary me-3" value="{{ $modo }} comentario">
    <a class="btn btn-success" href="{{ url('comentario') }}" >volver</a>
</div>