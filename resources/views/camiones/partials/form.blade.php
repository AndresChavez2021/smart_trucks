@csrf
<div class="row">
    <div class="col-12">
        <div class="form-floating">
            <input type="text" placeholder="nombre" class="form-control" name="nombre"
                value="{{ isset($camion) ? $camion->nombre : old('nombre') }}">
            <label>Nombre</label>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="form-floating">
            @if (isset($camion->image))
                <br>
                <br>
                <img src="{{ $camion->image }}" class="img-fluid" alt="Responsive image" width="150">
            @endif
            <input type="file" placeholder="image" class="form-control" name="image"
                value="{{ isset($camion) ? $camion->image : old('image') }}">
            <label>Imagen</label>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="form-floating">
            <input type="text" placeholder="placa" class="form-control" name="placa"
                value="{{ isset($camion) ? $camion->placa : old('placa') }}">
            <label>Placa</label>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="form-floating">
            <input type="text" placeholder="capacidad_personal" class="form-control" name="capacidad_personal"
                value="{{ isset($camion) ? $camion->capacidad_personal : old('capacidad_personal') }}">
            <label>Capacidad de Personal</label>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="form-floating">
            <input type="text" placeholder="capacidad_carga" class="form-control" name="capacidad_carga"
                value="{{ isset($camion) ? $camion->capacidad_carga : old('capacidad_carga') }}">
            <label>Capacidad de Carga</label>
        </div>
    </div>
</div>
