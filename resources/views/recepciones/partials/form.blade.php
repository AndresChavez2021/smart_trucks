@csrf
<div class="row">
    <div class="col-12">
        <div class="form-floating">
            <input type="int" placeholder="cantidad" class="form-control" name="cantidad"
                value="{{ isset($recepcion) ? $recepcion->cantidad : old('cantidad') }}">
            <label>Cantidad en Kgs</label>
        </div>
    </div>
    <div class="col-12">
        <div class="form-floating">
            <input type="text" placeholder="observacion" class="form-control" name="observacion"
                value="{{ isset($recepcion) ? $recepcion->observacion : old('observacion') }}">
            <label>Observación</label>
        </div>
    </div>
    <div class="col-12">
        <br>
        <label>
            <h5>Elegir Un Recorrido</h5>
        </label>
        <select name="id_recorrido" class="form-control">
            <option value=""> Seleccione Una Recorrido... </option>
            @foreach ($recorridos as $recorrido)
                <option value="{{ $recorrido->id }}" @if ((isset($recepcion->id_recorrido) ? $recepcion->id_recorrido : old('id_recorrido')) == $recorrido->id) selected @endif>
                    {{ $recorrido->fechaHora }} - {{ $recorrido->ruta }}
                </option>
            @endforeach
        </select>
        <br>
    </div>
    <div class="col-12">
        <br>
        <label>
            <h5>Elegir Un Tipo de Basura</h5>
        </label>
        <select name="id_basura" class="form-control">
            <option value=""> Seleccione Un Tipo de Basura... </option>
            @foreach ($basuras as $basura)
                <option value="{{ $basura->id }}" @if ((isset($recepcion->id_basura) ? $recepcion->id_basura : old('id_basura')) == $basura->id) selected @endif>
                    {{ $basura->nombre }}
                </option>
            @endforeach
        </select>
        <br>
    </div>
    <div class="col-12">
        <div class="form-floating">
            <?php date_default_timezone_set('America/La_Paz');
            $fechaHora = date('Y-m-d H:i:s'); ?>
            <input type="hidden" placeholder="fechaHora" class="form-control" name="fechaHora"
                value="{{ isset($recepcion) ? $recepcion->fechaHora : $fechaHora }}">
        </div>
    </div>
</div>
