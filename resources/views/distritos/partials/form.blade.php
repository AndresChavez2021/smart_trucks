@csrf
<div class="row">
    <div class="col-12">
        <div class="form-floating">
            <input type="text" placeholder="nombre" class="form-control" name="nombre"
                value="{{ isset($distrito) ? $distrito->nombre : old('nombre') }}">
            <label>Nombre</label>
        </div>
    </div>
    <div class="col-12">
        <div class="form-floating">
            <input type="text" placeholder="descripcion" class="form-control" name="descripcion"
                value="{{ isset($distrito) ? $distrito->descripcion : old('descripcion') }}">
            <label>Descripción</label>
        </div>
    </div>
    <div class="col-12">
        <br>
        <label>
            <h5>Elegir una Zona</h5>
        </label>
        <select name="id_zona" class="form-control">
            <option value=""> Seleccione Una Zona... </option>
            @foreach ($zonas as $zona)
                <option value="{{ $zona->id }}" @if ((isset($distrito->id_zona) ? $distrito->id_zona : old('id_zona')) == $zona->id) selected @endif>
                    {{ $zona->nombre }}
                </option>
            @endforeach
        </select>
        <br>
    </div>
</div>
