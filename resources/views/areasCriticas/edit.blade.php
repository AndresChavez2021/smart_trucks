@extends('layouts.app-master')
@section('content')
    <div class="card mt-4">
        <div class="card-header d-inline-flex">
            <h1>Formulario - Editar Areas Criticas</h1>
        </div>
        <div class="card-header d-inline-flex">
            <a href="{{ route('areasCriticas.index') }}" class="btn btn-primary ml-auto">
                <i class="fas fa-arrow-left"></i>
                Volver</a>
        </div>
        <div class="card-body">
            <form action="{{route('areasCriticas.update', $areaCritica->id)}}" method="POST" enctype="multipart/form-data" id="update">
                @method('PUT')
                @include('areasCriticas.partials.form')
            </form>
        </div>
        <div class="card-footer">
            <Button class="btn btn-primary" form="update">
                <i class="fas fa-pencil-alt"></i> Editar
            </Button>
        </div>
    </div>
@endsection
