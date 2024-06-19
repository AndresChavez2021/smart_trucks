@extends('layouts.app-master')
@section('content')
    <div class="card mt-4">
        <div class="card-header d-inline-flex">
            <h1>Formulario - Ver Red</h1>
        </div>
        <div class="card-header d-inline-flex">
            <a href="{{ route('redes.index') }}" class="btn btn-primary ml-auto">
                <i class="fas fa-arrow-left"></i>
                Volver</a>
        </div>
        <div class="card-body">
            <form action="{{ route('redes.store') }}" method="POST" enctype="multipart/form-data" id="create">
                @include('redes.partials.form')
            </form>
        </div>
        <div class="card-footer">
        </div>
    </div>
@endsection
