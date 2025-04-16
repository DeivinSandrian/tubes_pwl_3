@extends('layouts.auth')

@section('title', 'Login')
    
@section('content')
    <h3 class="card-title text-left mb-3">Sign In</h3>
    <h6 class="fw-light">Login to manage your account.</h6>
    @if (session('status'))
        <div class="alert alert-success mb-4">
            {{ session('status') }}
        </div>
    @endif
    <form class="pt-3" method="POST" action="{{ route('login') }}">
        @csrf
        <div class="form-group">
            <input type="email" name="email" id="email" class="form-control form-control-lg @error('email') is-invalid @enderror" placeholder="Email" value="{{ old('email') }}" required autofocus>
            @error('email')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-group">
            <input type="password" name="password" id="password" class="form-control form-control-lg @error('password') is-invalid @enderror" placeholder="Password" required>
            @error('password')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="mt-3">
            <button type="submit" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn">Sign In</button>
        </div>
        <!-- <div class="my-2 d-flex justify-content-between align-items-center">
            <a href="{{ route('password.request') }}" class="auth-link text-black">Forgot password?</a>
        </div> -->
        <div class="text-center mt-4 fw-light">
            Don't have an account? <a href="{{ route('register') }}" class="text-primary">Create one</a>
        </div>
    </form>
@endsection