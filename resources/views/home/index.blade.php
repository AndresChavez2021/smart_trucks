@extends('layouts.app-master')
@section('content')
    <h1>Home</h1>
    @auth
        <p>Bienvenido {{ auth()->user()->name ?? auth()->user()->email }}, estás autenticado a la página.</p>
    @endauth





    <h1>aqui hare mis graficas </h1>




@endsection