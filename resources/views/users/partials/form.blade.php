@csrf
<div class="row">
    <div class="col-12">
        <div class="form-floating">
            <input type="text" placeholder="name" class="form-control" name="name"
                value="{{ isset($user) ? $user->name : old('name') }}">
            <label>Nombre</label>
        </div>
    </div>
    <div class="col-12">
        <div class="form-floating">
            <input type="text" placeholder="apellidos" class="form-control" name="apellidos"
                value="{{ isset($user) ? $user->apellidos : old('apellidos') }}">
            <label>Apellidos</label>
        </div>
    </div>
    <div class="col-12">
        <div class="form-floating">
            <input type="number" placeholder="ci" class="form-control" name="ci"
                value="{{ isset($user) ? $user->ci : old('ci') }}">
            <label>CI</label>
        </div>
    </div>
    <div class="col-12">
        <h5>Género</h5>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="sexo" id="flexRadioDefault1" value="M"
                @if ((isset($user) ? $user->sexo : old('sexo')) == 'M') checked @endif>
            <label class="form-check-label" for="flexRadioDefault1">
                Masculine
            </label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="sexo" id="flexRadioDefault1" value="F"
                @if ((isset($user) ? $user->sexo : old('sexo')) == 'F') checked @endif>
            <label class="form-check-label" for="flexRadioDefault2">
                Female
            </label>
        </div>
    </div>
    <div class="col-12">
        <div class="form-floating">
            <input type="number" placeholder="phone" class="form-control" name="phone"
                value="{{ isset($user) ? $user->phone : old('phone') }}">
            <label>Teléfono</label>
        </div>
    </div>
    <div class="col-12">
        <div class="form-floating">
            <input type="email" placeholder="email" class="form-control" name="email"
                value="{{ isset($user) ? $user->email : old('email') }}">
            <label>E-Mail</label>
        </div>
    </div>
    <div class="col-12">
        <div class="form-floating">
            <input type="password" placeholder="password" class="form-control" name="password"
                value="{{ isset($user) ? $user->password : old('password') }}">
            <label>Contraseña</label>
        </div>
    </div>
    <div class="col-12">
        <div class="form-floating">
            <input type="password" placeholder="password_confirmation" class="form-control" name="password_confirmation"
                value="{{ isset($user) ? $user->password : old('password') }}">
            <label>Confirmar Contraseña</label>
        </div>
    </div>
    @if ($user->tipoc == 1)
        <input type="hidden" name="tipoc" class="form-control" id="exampleInputPassword1" value="1">
        <input type="hidden" name="tipoe" class="form-control" id="exampleInputPassword1" value="0">
    @else
        <div class="col-12">
            <div class="form-floating">
                <input type="text" placeholder="domicilio" class="form-control" name="domicilio"
                    value="{{ isset($user) ? $user->domicilio : old('domicilio') }}">
                <label>Domicilio</label>
            </div>
        </div>
        <div class="col-12">
            <h5>Estado</h5>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="estado" id="flexRadioDefault1" value="0"
                    @if ((isset($user) ? $user->estado : old('estado')) == '0') checked @endif>
                <label class="form-check-label" for="flexRadioDefault1">
                    Inactivo
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="estado" id="flexRadioDefault1" value="1"
                    @if ((isset($user) ? $user->estado : old('estado')) == '1') checked @endif>
                <label class="form-check-label" for="flexRadioDefault1">
                    Activo
                </label>
            </div>
        </div>
        <input type="hidden" name="tipoc" class="form-control" id="exampleInputPassword1" value="0">
        <input type="hidden" name="tipoe" class="form-control" id="exampleInputPassword1" value="1">
    @endif
</div>
