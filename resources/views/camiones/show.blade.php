@extends('layouts.app-master')
@section('content')
    <div class="card mt-4">
        <div class="card-header d-inline-flex">
            <h1>Formulario - Ver Camión</h1>
        </div>
        <div class="card-header d-inline-flex">
            <a href="{{ route('camiones.index') }}" class="btn btn-primary ml-auto">
                <i class="fas fa-arrow-left"></i>
                Volver</a>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-12">
                    <div class="form-floating">
                        <input type="text" placeholder="nombre" class="form-control" name="nombre"
                            value="{{ isset($camion) ? $camion->nombre : old('nombre') }}" readonly>
                        <label>Nombre</label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="form-floating">
                        <input type="text" placeholder="placa" class="form-control" name="placa"
                            value="{{ isset($camion) ? $camion->placa : old('placa') }}" readonly>
                        <label>Placa</label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="form-floating">
                        @if (isset($camion->image))
                            <br>
                            <br>
                            <img src="{{ $camion->image }}" class="img-fluid" alt="Responsive image" width="150">
                        @endif
                        <input type="hidden" placeholder="image" class="form-control" name="image"
                            value="{{ isset($camion) ? $camion->image : old('image') }}">
                        <label>Imagen</label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="form-floating">
                        <input type="number" placeholder="capacidad_personal" class="form-control"
                            name="capacidad_personal"
                            value="{{ isset($camion) ? $camion->capacidad_personal : old('capacidad_personal') }}" readonly>
                        <label>Capacidad de Personal</label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="form-floating">
                        <input type="number" placeholder="capacidad_carga" class="form-control" name="capacidad_carga"
                            value="{{ isset($camion) ? $camion->capacidad_carga : old('capacidad_carga') }}" readonly>
                        <label>Capacidad de Carga</label>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer">
        </div>
    </div>
@endsection
