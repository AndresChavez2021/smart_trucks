@extends('layouts.auth-client')
@section('content')
    <br>
    <main class="container">
        <br><br>
        <section class="page-section portfolio" id="portfolio">
            <div class="container">
                @include('layouts.partials.messages')
                <!-- Portfolio Section Heading-->
                <h2 class="page-section-heading text-center text-uppercase text-secondary mb-0">Iniciar sesión</h2>
                <!-- Icon Divider-->
                <div class="divider-custom">
                    <div class="divider-custom-line"></div>
                    <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
                    <div class="divider-custom-line"></div>
                </div>
            </div>
            <div class="row justify-content-center">
                <center>
                    <form action="/login" method="POST" style="width: 40%">
                        @csrf
                        <div class="form-floating mb-3">
                            <input type="email" name="email" class="form-control" id="exampleInputEmail1"
                                aria-describedby="emailHelp" placeholder="email">
                            <label for="exampleInputEmail1" class="form-label">Email address</label>
                            <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="password" name="password" class="form-control" id="exampleInputPassword1"
                                placeholder="password">
                            <label for="exampleInputPassword1" class="form-label">Password</label>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </center>
            </div>
        </section>
    </main>
@endsection
