@extends('layouts.app-master')
@section('content')
    <div class="card mt-4">
        <div class="card-header d-inline-flex">
            <h1>Formulario - Areas Criticas de la recorrido</h1>
        </div>
        <div class="card-header d-inline-flex">
            <a href="{{ route('recorridos.index') }}" class="btn btn-primary ml-auto">
                <i class="fas fa-arrow-left"></i>
                Volver</a>
        </div>
        <div class="card-body">
            <form action="{{route('recorridos.update', $recorrido->id)}}" method="POST" enctype="multipart/form-data" id="update">
                @method('PUT')
                @include('recorridos.partials.form')
            </form>
        </div>
    </div>
@endsection
