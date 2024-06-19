@csrf
<div class="row">
    <div class="col-12">
        <label>
            <h5> Empleados </h5>
        </label> <br>
        @foreach ($empleados as $empleado)
            <label>{{ Form::checkbox('empleados[]', $empleado->id, in_array($empleado->id, $Nro) ? true : false, ['class' => 'name']) }}
                {{ $empleado->name }}</label><br>
        @endforeach
    </div>
    <div class="col-12">
        <br>
        <label>
            <h5>Elegir un Vehículo</h5>
        </label>
        <select name="id_camion" class="form-control">
            <option value=""> Seleccione Un Vehículo... </option>
            @foreach ($camions as $camion)
                <option value="{{ $camion->id }}" @if ((isset($equipoRecorrido->id_camion) ? $equipoRecorrido->id_camion : old('id_camion')) == $camion->id) selected @endif>
                    {{ $camion->nombre }}
                </option>
            @endforeach
        </select>
        <br>
    </div>
</div>
