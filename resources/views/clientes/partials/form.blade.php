@csrf
<div class="row">
    <div class="col-12">
        <div class="form-floating">
            <input type="text" placeholder="name" class="form-control" name="name"
                value="{{ isset($cliente) ? $cliente->name : old('name') }}">
            <label>Nombre</label>
        </div>
    </div>
    <div class="col-12">
        <div class="form-floating">
            <input type="text" placeholder="apellidos" class="form-control" name="apellidos"
                value="{{ isset($cliente) ? $cliente->apellidos : old('apellidos') }}">
            <label>Apellidos</label>
        </div>
    </div>
    <div class="col-12">
        <div class="form-floating">
            <input type="file" placeholder="image" class="form-control" name="image"
                value="{{ isset($cliente) ? $cliente->image : old('image') }}">
            <label>Imagen</label>
        </div>
    </div>
    <div class="col-12">
        <div class="form-floating">
            <input type="number" placeholder="ci" class="form-control" name="ci"
                value="{{ isset($cliente) ? $cliente->ci : old('ci') }}">
            <label>CI</label>
        </div>
    </div>
    <div class="col-12">
        <h5>Género</h5>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="sexo" id="flexRadioDefault1" value="M"
                @if ((isset($cliente->sexo) ? $cliente->sexo : old('sexo')) == 'M') checked @endif>
            <label class="form-check-label" for="flexRadioDefault1">
                Masculine
            </label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="sexo" id="flexRadioDefault1" value="F"
                @if ((isset($cliente->sexo) ? $cliente->sexo : old('sexo')) == 'F') checked @endif>
            <label class="form-check-label" for="flexRadioDefault2">
                Female
            </label>
        </div>
    </div>
    <div class="col-12">
        <div class="form-floating">
            <input type="number" placeholder="phone" class="form-control" name="phone"
                value="{{ isset($cliente) ? $cliente->phone : old('phone') }}">
            <label>Teléfono</label>
        </div>
    </div>
    <div class="col-12">
        <div class="form-floating">
            <input type="email" placeholder="email" class="form-control" name="email"
                value="{{ isset($cliente) ? $cliente->email : old('email') }}">
            <label>E-Mail</label>
        </div>
    </div>
    @if ((isset($cliente->id) ? $cliente->id : '') == '')
        <div class="col-12">
            <div class="form-floating">
                <input type="password" placeholder="password" class="form-control" name="password"
                    value="{{ isset($cliente) ? $cliente->password : old('password') }}">
                <label>Contraseña</label>
            </div>
        </div>
        <div class="col-12">
            <div class="form-floating">
                <input type="password" placeholder="password_confirmation" class="form-control"
                    name="password_confirmation" value="{{ isset($cliente) ? $cliente->password : old('password') }}">
                <label>Confirmar Contraseña</label>
            </div>
        </div>
    @endif
    <div class="col-12">
        <div class="form-floating">
            <input type="double" placeholder="latitud" class="form-control" name="latitud"
                value="{{ isset($cliente) ? $cliente->latitud : old('latitud') }}">
            <label>Latitud</label>
        </div>
    </div>
    <div class="col-12">
        <div class="form-floating">
            <input type="double" placeholder="longitud" class="form-control" name="longitud"
                value="{{ isset($cliente) ? $cliente->longitud : old('longitud') }}">
            <label>Longitud</label>
        </div>
    </div>
    <div class="col-12">
        <br>
        <label>
            <h5>Elegir Una Ruta</h5>
        </label>
        <select name="id_ruta" class="form-control">
            <option value=""> Seleccione Una Ruta... </option>
            @foreach ($rutas as $ruta)
                <option value="{{ $ruta->id }}" @if ((isset($ruta->id_ruta) ? $ruta->id_ruta : old('id_ruta')) == $ruta->id) selected @endif>
                    {{ $ruta->nombre }}
                </option>
            @endforeach
        </select>
        <br>
    </div>
    <input type="hidden" name="tipoc" class="form-control" id="exampleInputPassword1" value="1">
    <input type="hidden" name="tipoe" class="form-control" id="exampleInputPassword1" value="0">
</div>
