@extends('layouts.auth-client')
@section('content')
    <br>
    <main class="container">
        <br><br>
        <!-- Portfolio Section-->
        <section class="page-section portfolio" id="portfolio">
            <div class="container">
                @include('layouts.partials.messages')
                <!-- Portfolio Section Heading-->
                <h2 class="page-section-heading text-center text-uppercase text-secondary mb-0">Perfil</h2>
                <!-- Icon Divider-->
                <div class="divider-custom">
                    <div class="divider-custom-line"></div>
                    <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
                    <div class="divider-custom-line"></div>
                </div>
                <!-- Portfolio Grid Items-->
                <div class="row justify-content-center">
                    <!-- Portfolio Item 1-->
                    <div class="container">
                        <a href="{{ route('perfil.index') }}" class="btn btn-primary ml-auto">
                            <i class="fas fa-arrow-left"></i>
                            Volver</a>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('perfil.update', auth()->user()->id) }}" method="POST"
                            enctype="multipart/form-data" id="update">
                            @method('PUT')
                            @include('perfil.partials.form')
                        </form>
                    </div>
                    <div class="card-footer">
                        <Button class="btn btn-primary" form="update">
                            <i class="fas fa-pencil-alt"></i> Editar
                        </Button>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection