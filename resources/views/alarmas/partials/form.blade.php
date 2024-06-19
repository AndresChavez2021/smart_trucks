@csrf
<div class="row">
    <div class="col-12">
        <div class="form-floating">
            <input type="text" placeholder="nombre" class="form-control" name="nombre"
                value="{{ isset($alarma) ? $alarma->nombre : old('nombre') }}">
            <label>Nombre</label>
        </div>
    </div>
    <div class="col-12">
        <div class="form-floating">
            <?php date_default_timezone_set('America/La_Paz');
            $fechaHora = date('Y-m-d H:i:s'); ?>
            <input type="hidden" placeholder="fechaHora" class="form-control" name="fechaHora"
                value="{{ isset($alarma) ? $alarma->fechaHora : $fechaHora }}">
            <label>Fecha - Hora</label>
        </div>
    </div>
    <div class="col-12">
        <div class="form-floating">
            <input type="integer" placeholder="radio" class="form-control" name="radio"
                value="{{ isset($alarma) ? $alarma->radio : old('radio') }}">
            <label>Radio en Metros</label>
        </div>
    </div>
    @if (!isset($alarma))
        <input type="hidden" value="1" name="estado">
    @else
        <div class="col-12">
            <br>
            <h5>Estado</h5>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="estado" id="flexRadioDefault1" value="0"
                    @if ((isset($alarma->estado) ? $alarma->estado : old('estado')) == '0') checked @endif>
                <label class="form-check-label" for="flexRadioDefault1">
                    Finalizado
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="estado" id="flexRadioDefault1" value="1"
                    @if ((isset($alarma->estado) ? $alarma->estado : old('estado')) == '1') checked @endif>
                <label class="form-check-label" for="flexRadioDefault1">
                    Iniciado
                </label>
            </div>
        </div>
    @endif
    <div class="col-12">
        <br>
        <label>
            <h5>Elegir una cliente</h5>
        </label>
        <select name="id_cliente" class="form-control">
            <option value=""> Seleccione Un Cliente... </option>
            @foreach ($clientes as $cliente)
                <option value="{{ $cliente->id }}" @if ((isset($alarma->id_cliente) ? $alarma->id_cliente : old('id_cliente')) == $cliente->id) selected @endif>
                    {{ $cliente->name }}
                </option>
            @endforeach
        </select>
        <br>
    </div>
</div>
