@extends('layouts.app-master')
@section('content')
    <div class="card mt-4">
        <div class="card-header d-inline-flex">
            <h1>Formulario - Crear Camión</h1>
        </div>
        <div class="card-header d-inline-flex">
            <a href="{{ route('camiones.index') }}" class="btn btn-primary ml-auto">
                <i class="fas fa-arrow-left"></i>
                Volver</a>
        </div>
        <div class="card-body">
            <form action="{{ route('camiones.store') }}" method="POST" enctype="multipart/form-data" id="create">
                @csrf
                <div class="row">
                    <div class="col-12">
                        <div class="form-floating">
                            <input type="text" placeholder="nombre" class="form-control" name="nombre"
                                value="{{ isset($camion) ? $camion->nombre : old('nombre') }}">
                            <label>Nombre</label>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="form-floating">
                            <input type="text" placeholder="placa" class="form-control" name="placa"
                                value="{{ isset($camion) ? $camion->placa : old('placa') }}">
                            <label>Placa</label>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="form-floating">
                            <input type="file" class="form-control" name="imagen">
                            <label>Imagen</label>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="form-floating">
                            <input type="number" placeholder="capacidad_personal" class="form-control" name="capacidad_personal"
                                value="{{ isset($camion) ? $camion->capacidad_personal : old('capacidad_personal') }}">
                            <label>Capacidad de Personal</label>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="form-floating">
                            <input type="number" placeholder="capacidad_carga" class="form-control" name="capacidad_carga"
                                value="{{ isset($camion) ? $camion->capacidad_carga : old('capacidad_carga') }}">
                            <label>Capacidad de Carga</label>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="card-footer">
            <button class="btn btn-primary" form="create">
                <i class="fas fa-plus"></i> Crear
            </button>
        </div>
    </div>
@endsection
