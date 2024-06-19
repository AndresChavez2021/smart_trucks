@extends('layouts.auth-client')
@section('content')
    <!-- Masthead-->
    <header class="masthead bg-primary text-white text-center">
        <div class="container d-flex align-items-center flex-column">
            <!-- Masthead Avatar Image-->
            <img class="masthead-avatar mb-5" src="{{ asset('assets/img/trash.svg') }}" alt="..." />
            <!-- Masthead Heading-->
            <h1 class="masthead-heading text-uppercase mb-0">Software Basurero Inteligente</h1>
            <!-- Icon Divider-->
            <div class="divider-custom divider-light">
                <div class="divider-custom-line"></div>
                <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
                <div class="divider-custom-line"></div>
            </div>
            <!-- Masthead Subheading-->
            <p class="masthead-subheading font-weight-light mb-0">Camiones, Rutas, Recorridos, Zonas ...</p>
        </div>
    </header>
    @include('components.flash_alerts')
    <!-- Features Section -->
    <section class="page-section features" id="features">
        <div class="container">
            <!-- Section Heading -->
            <h2 class="page-section-heading text-center text-uppercase text-secondary">Características</h2>
            <!-- Icon Divider -->
            <div class="divider-custom">
                <div class="divider-custom-line"></div>
                <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
                <div class="divider-custom-line"></div>
            </div>
            <!-- Features Grid -->
            <div class="row justify-content-center">
                <div class="col-md-6 col-lg-4 mb-5">
                    <div class="portfolio-item mx-auto">
                        <img class="img-fluid" src="{{ asset('assets/img/portfolio/camion.png') }}" alt="Bus 1" />
                    </div>
                    <div class="text-center mt-3">
                        <i class="fas fa-bus feature-icon"></i>
                        <h3 class="feature-title">Gestión de Autobuses</h3>
                        <p class="feature-description">Administre y monitoree su flota de autobuses de manera eficiente.</p>
                    </div>
                </div>
                <!-- Portfolio Item 2 -->
                <div class="col-md-6 col-lg-4 mb-5">
                    <div class="portfolio-item mx-auto">
                        <img class="img-fluid" src="{{ asset('assets/img/portfolio/recorrido.png') }}" alt="Bus 2" />
                    </div>
                    <div class="text-center mt-3">
                        <img class="img-fluid" src="{{ asset('assets/img/portfolio/icon_recorrido.png') }}" alt="Bus 2" width="30" />
                        <h3 class="feature-title">Recorridos</h3>
                        <p class="feature-description">Registra los recorridos de los vehiculos en las rutas de trabajo para realizar un mayor control del personal.</p>
                    </div>
                </div>
                <!-- Portfolio Item 3 -->
                <div class="col-md-6 col-lg-4 mb-5">
                    <div class="portfolio-item mx-auto">
                        <img class="img-fluid" src="{{ asset('assets/img/portfolio/ruta.png') }}" alt="Bus 3" />
                    </div>
                    <div class="text-center mt-3">
                        <i class="fas fa-map-marked-alt feature-icon"></i>
                        <h3 class="feature-title">Rutas Personalizadas</h3>
                        <p class="feature-description">Planifique y optimice rutas personalizadas para una mejor eficiencia y satisfacción del cliente.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Contact Section, Footer Section, and other sections... -->
@endsection