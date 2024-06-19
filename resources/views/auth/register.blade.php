@extends('layouts.auth-master')
@section('content')
    <form action="/register" method="POST" style="width: 40%">
        @csrf
        <h1>Create account</h1>
        @include('layouts.partials.messages')
        <div class="form-floating mb-3">
            <input type="text" name="name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                placeholder="name">
            <label for="exampleInputEmail1">Name</label>
        </div>
        <div class="form-floating mb-3">
            <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                placeholder="email">
            <label for="exampleInputEmail1" class="form-label">Email address</label>
            <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
        </div>
        <div class="form-floating mb-3">
            <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="password">
            <label for="exampleInputPassword1" class="form-label">Password</label>
        </div>
        <div class="form-floating mb-3">
            <input type="password" name="password_confirmation" class="form-control" id="exampleInputPassword1"
                placeholder="password_confirmation">
            <label for="exampleInputPassword1" class="form-label">Password confirmation</label>
        </div>
        <button type="submit" class="btn btn-primary">Create account</button>
    </form>
@endsection
