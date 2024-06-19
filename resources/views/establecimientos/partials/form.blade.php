@csrf
<div class="row">
    <div class="col-12">
        <div class="form-floating">
            <input type="text" placeholder="nombre" class="form-control" name="nombre"
                value="{{ isset($establecimiento) ? $establecimiento->nombre : old('nombre') }}">
            <label>Nombre</label>
        </div>
    </div>
    <div class="col-12">
        <br>
        <label>
            <h5>Elegir un Distrito</h5>
        </label>
        <select name="id_distrito" class="form-control">
            <option value=""> Seleccione Una distrito... </option>
            @foreach ($distritos as $distrito)
                <option value="{{ $distrito->id }}" @if ((isset($establecimiento->id_distrito) ? $establecimiento->id_distrito : old('id_distrito')) == $distrito->id) selected @endif>
                    {{ $distrito->nombre }}
                </option>
            @endforeach
        </select>
        <br>
    </div>
    <div class="col-12">
        <br>
        <label>
            <h5>Elegir una Ruta</h5>
        </label>
        <select name="id_ruta" class="form-control">
            <option value=""> Seleccione Una Ruta... </option>
            @foreach ($rutas as $ruta)
                <option value="{{ $ruta->id }}" @if ((isset($establecimiento->id_ruta) ? $establecimiento->id_ruta : old('id_ruta')) == $ruta->id) selected @endif>
                    {{ $ruta->nombre }}
                </option>
            @endforeach
        </select>
        <br>
    </div>
    <div class="col-12">
        <br>
        <label>
            <h5>Elegir una Red</h5>
        </label>
        <select name="id_red" class="form-control">
            <option value=""> Seleccione Una Red... </option>
            @foreach ($redes as $red)
                <option value="{{ $red->id }}" @if ((isset($establecimiento->id_red) ? $establecimiento->id_red : old('id_red')) == $red->id) selected @endif>
                    {{ $red->nombre }}
                </option>
            @endforeach
        </select>
        <br>
    </div>
</div>
