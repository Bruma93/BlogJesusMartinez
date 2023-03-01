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

<div class="form-group mb-3">
    <label for="nombre">Nombre</label>
    <input type="text" class="form-control" name="nombre" id="nombre" value="{{ isset($producto->nombre) ? $producto->nombre : old('nombre') }}">
</div>
<div class="form-group mb-3">
    <label for="description">Descripción</label>
    <input type="text" class="form-control" name="description" id="description" value="{{ isset($producto->description) ? $producto->description : old('description') }}">
</div>
<div class="form-group mb-3">
    <label for="quantity">Cantidad</label>
    <input type="number" class="form-control" name="quantity" id="quantity" value="{{ isset($producto->quantity) ? $producto->quantity : old('quantity') }}">
</div>
<div class="form-group mb-3">
    <label for="status">Estatus</label>
    <input type="number" class="form-control" name="status" id="status" value="{{ isset($producto->status) ? $producto->status : old('status') }}">
</div>
<div class="form-group mb-3">
    <label for="seller_id">Id del vendedor</label>
    <input type="number" class="form-control" name="seller_id" id="seller_id" value="{{ isset($producto->seller_id) ? $producto->seller_id : old('seller_id') }}">
</div>
<div class="mt-5">
    <input type="submit" class="btn btn-primary me-3" value="{{ $modo }} producto">
    <a class="btn btn-success" href="{{ url('producto') }}" >volver</a>
</div>