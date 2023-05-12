@extends('layout/template');

@section('content')
    <div class="w-50 center border rounded px-3 py-3 mx-">
        <h1>Login</h1>
        <form action="/sesi/login" method="POST">
            @csrf
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" value="{{Session::get('email')}}" name="email" class="form-control">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" name="password" class="form-control">
            </div>
            <div class="mb-3 d-grid">
                <button name="submit" type="submit" class="btn btn-primary">Login</button>
            </div>
        </form>
        <form action="/sesi/register" method="GET">
            <div class="mb-3 d-grid">
                <button style="background-color:#e6ad29; border-color:#e6ad29;" name="register" type="submit" class="btn btn-primary">Register</button>
            </div>
        </form>
    </div>
        

@endsection