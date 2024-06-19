@csrf
<div class="row">
    <div class="col-12">
        <label>
            <h5> Dias de la Semana </h5>
        </label> <br>
        <label>{{ Form::checkbox('dia_semana[]', 'Lunes', in_array('Lunes', $diasDeLaSemana) ? true : false, ['class' => 'name']) }}
            {{ 'Lunes' }}</label><br>
        <label>{{ Form::checkbox('dia_semana[]', 'Martes', in_array('Martes', $diasDeLaSemana) ? true : false, ['class' => 'name']) }}
            {{ 'Martes' }}</label><br>
        <label>{{ Form::checkbox('dia_semana[]', 'Miércoles', in_array('Miércoles', $diasDeLaSemana) ? true : false, ['class' => 'name']) }}
            {{ 'Miércoles' }}</label><br>
        <label>{{ Form::checkbox('dia_semana[]', 'Jueves', in_array('Jueves', $diasDeLaSemana) ? true : false, ['class' => 'name']) }}
            {{ 'Jueves' }}</label><br>
        <label>{{ Form::checkbox('dia_semana[]', 'Viernes', in_array('Viernes', $diasDeLaSemana) ? true : false, ['class' => 'name']) }}
            {{ 'Viernes' }}</label><br>
        <label>{{ Form::checkbox('dia_semana[]', 'Sábado', in_array('Sábado', $diasDeLaSemana) ? true : false, ['class' => 'name']) }}
            {{ 'Sábado' }}</label><br>
        <label>{{ Form::checkbox('dia_semana[]', 'Domingo', in_array('Domingo', $diasDeLaSemana) ? true : false, ['class' => 'name']) }}
            {{ 'Domingo' }}</label><br>
    </div>
    <div class="col-12">
        <div class="form-floating">
            <input type="time" placeholder="hora_inicio" class="form-control" name="hora_inicio"
                value="{{ isset($horario) ? $horario->hora_inicio : old('hora_inicio') }}">
            <label>Hora de Inicio</label>
        </div>
    </div>
    <div class="col-12">
        <div class="form-floating">
            <input type="time" placeholder="hora_fin" class="form-control" name="hora_fin"
                value="{{ isset($horario) ? $horario->hora_fin : old('hora_fin') }}">
            <label>Hora de Finalización</label>
        </div>
    </div>
</div>
