@csrf
<div class="row">
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
