@csrf
<div class="row">
    <div class="col-12">
        <div class="form-floating">
            <input type="text" placeholder="descripcion" class="form-control" name="descripcion"
                value="{{ isset($reclamo) ? $reclamo->descripcion : old('descripcion') }}">
            <label>Descripción</label>
        </div>
    </div>
    <div class="col-12">
        <div class="form-floating">
            <?php date_default_timezone_set('America/La_Paz');
            $fechaHora = date('Y-m-d H:i:s'); ?>
            <input type="hidden" placeholder="fechaHora" class="form-control" name="fechaHora"
                value="{{ isset($reclamo) ? $reclamo->fechaHora : $fechaHora }}">
        </div>
    </div>
    <div class="col-12">
        <br>
        <label>
            <h5>Elegir un Cliente</h5>
        </label>
        <select name="id_cliente" class="form-control">
            <option value=""> Seleccione Un Cliente... </option>
            @foreach ($clientes as $cliente)
                <option value="{{ $cliente->id }}" @if ((isset($reclamo->id_cliente) ? $reclamo->id_cliente : old('id_cliente')) == $cliente->id) selected @endif>
                    {{ $cliente->name }}
                </option>
            @endforeach
        </select>
        <br>
    </div>
</div>
