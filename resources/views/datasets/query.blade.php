@extends('layouts.app-master')
@section('content')
    <div class="card mt-4">
        <div class="card-header d-inline-flex">
            <h1>Consulta</h1>
        </div>
        <div class="card-header d-inline-flex">
            <a href="{{ route('datasets.index') }}" class="btn btn-primary ml-auto">
                <i class="fas fa-arrow-left"></i>
                Volver</a>
        </div>
        <div class="card-body">
            <form action="{{ route('datasets.queryStore') }}" method="POST" enctype="multipart/form-data" id="create">
                @csrf
                <div class="row">
                    <div class="col-12">
                        <br>
                        <label>
                            <h5>Tipo De Basura</h5>
                        </label>
                        <select name="id_basura" class="form-control" id="id_basura" onchange="handleSelectChange()">
                            <option value=""> Elegir Un Tipo De Basura... </option>
                            @foreach ($basuras as $basura)
                                <option value="{{ $basura->id }}">
                                    {{ $basura->tipo }}
                                </option>
                            @endforeach
                        </select>
                        <br>
                    </div>
                    <!--
                    <div class="col-12">
                        <br>
                        <label>
                            <h5>Elegir un zona</h5>
                        </label>
                        <select name="id_zona" class="form-control" id="id_zona" onchange="handleSelectChange()">
                            <option value=""> Seleccione Un zona... </option>
                            @foreach ($zonas as $zona)
                                <option value="{{ $zona->id }}">
                                    {{ $zona->nombre }}
                                </option>
                            @endforeach
                        </select>
                        <br>
                    </div>
                -->
                    <div class="col-12">
                        <br>
                        <label>
                            <h5>Elegir un distrito</h5>
                        </label>
                        <select name="id_distrito" class="form-control" id="id_distrito" onchange="handleSelectChange()">
                            <option value=""> Seleccione Un distrito... </option>
                            @foreach ($distritos as $distrito)
                                <option value="{{ $distrito->id }}">
                                    {{ $distrito->nombre }}
                                </option>
                            @endforeach
                        </select>
                        <br>
                    </div>
                    <!--
                    <div class="col-12">
                        <br>
                        <label>
                            <h5>Elegir un Horario</h5>
                        </label>
                        <select name="id_horario" class="form-control" id="id_horario" onchange="handleSelectChange()">
                            <option value=""> Seleccione Un Horario... </option>
                            @foreach ($horarios as $horario)
                                <option value="{{ $horario->id }}">
                                    {{ $horario->dia_semana }} - {{ $horario->hora_inicio }} - {{ $horario->hora_fin }}
                                </option>
                            @endforeach
                        </select>
                        <br>
                    </div>
                
                    <div class="col-12">
                        <br>
                        <label>
                            <h5>Elegir Una Ruta</h5>
                        </label>
                        <select name="id_ruta" class="form-control" id="id_ruta" onchange="id_ruta()">
                            <option value=""> Seleccione Una Ruta... </option>
                            @foreach ($rutas as $ruta)
                                <option value="{{ $ruta->id }}">
                                    {{ $ruta->nombre }} - {{$ruta->descripcion}}
                                </option>
                            @endforeach
                        </select>
                        <br>
                    </div>
                    <div class="col-12">
                        <br>
                        <label>
                            <h5>Elegir un establecimiento</h5>
                        </label>
                        <select name="id_establecimiento" class="form-control" id="id_establecimiento" onchange="handleSelectChange()">
                            <option value=""> Seleccione Un establecimiento... </option>
                            @foreach ($establecimientos as $establecimiento)
                                <option value="{{ $establecimiento->id }}">
                                    {{ $establecimiento->nombre }}
                                </option>
                            @endforeach
                        </select>
                        <br>
                    </div>
                -->
                    <div class="col-12">
                        <div class="form-floating">
                            <input type="date" placeholder="Fecha Inicio" class="form-control" name="fecha_inicio"
                                value="">
                            <label>Fecha de Inicio</label>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-floating">
                            <input type="date" placeholder="Fecha Fin" class="form-control" name="fecha_fin"
                                value="">
                            <label>Fecha de Fin</label>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="card-footer">
            <Button class="btn btn-primary" form="create">
                <i class="fas fa-plus"></i> Crear Consulta
            </Button>
        </div>
    </div>
    <script>
        function handleSelectChange() {
            /*var id_basura = document.getElementById("id_basura");
            var id_establecimiento = document.getElementById("id_establecimiento");
            var id_distrito = document.getElementById("id_distrito");
            var id_zona = document.getElementById("id_zona");
            var id_horario = document.getElementById("id_horario");
            var id_ruta = document.getElementById("id_ruta");
            if (id_establecimiento != null) {
                id_zona.disabled = true;
                id_distrito.disabled = true;
                id_horario.disabled = true;
                id_basura.disabled = true;
                id_ruta.disabled = true;
            }
            if (id_distrito != null) {
                id_zona.disabled = true;
            }*/
        }

        function id_ruta(){
            /*var id_basura = document.getElementById("id_basura");
            var id_establecimiento = document.getElementById("id_establecimiento");
            var id_distrito = document.getElementById("id_distrito");
            var id_zona = document.getElementById("id_zona");
            var id_horario = document.getElementById("id_horario");
            var id_ruta = document.getElementById("id_ruta");
            if (id_ruta != null) {
                id_zona.disabled = true;
                id_distrito.disabled = true;
                id_establecimiento.disabled = true;
                id_horario.disabled = true;
                id_basura.disabled = true;
            }*/
        }
    </script>
@endsection
