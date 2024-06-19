@extends('layouts.auth-client')
@section('content')
    <br>
    <main class="container">
        <br><br>
        <section class="page-section portfolio" id="portfolio">
            <div class="container">
                @include('layouts.partials.messages')
                <!-- Portfolio Section Heading-->
                <h2 class="page-section-heading text-center text-uppercase text-secondary mb-0">Cambiar Contraseña</h2>
                <!-- Icon Divider-->
                <div class="divider-custom">
                    <div class="divider-custom-line"></div>
                    <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
                    <div class="divider-custom-line"></div>
                </div>
            </div>
            <a href="{{ route('password.index') }}" class="btn btn-primary ml-auto">
                <i class="fas fa-arrow-left"></i>
                Volver</a>
            <div class="row justify-content-center">
                <center>
                    <div class="card-body">
                        <form action="{{ route('password.update', auth()->user()->id) }}" method="POST"
                            enctype="multipart/form-data" id="update">
                            @method('PUT')
                            @include('perfil.partials.formPass')
                        </form>
                    </div>
                </center>
            </div>
            <Button class="btn btn-primary" form="update">
                <i class="fas fa-pencil-alt"></i> Cambiar
            </Button>
        </section>
    </main>
@endsection