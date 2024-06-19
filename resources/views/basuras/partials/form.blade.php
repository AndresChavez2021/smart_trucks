@csrf
<div class="row">
    <div class="col-12">
        <div class="form-floating">
            <input type="text" placeholder="nombre" class="form-control" name="nombre"
                value="{{ isset($basura) ? $basura->nombre : old('nombre') }}">
            <label>Nombre</label>
        </div>
    </div>
    <div class="col-12">
        <div class="form-floating">
            <input type="text" placeholder="tipo" class="form-control" name="tipo"
                value="{{ isset($basura) ? $basura->tipo : old('tipo') }}">
            <label>Tipo</label>
        </div>
    </div>
    <div class="col-12">
        <div class="form-floating">
            <input type="float" placeholder="precio de compra" class="form-control" name="precio_venta"
                value="{{ isset($basura) ? $basura->precio_venta : old('precio_venta') }}">
            <label>Precio de Compra </label>
        </div>
    </div>
</div>
