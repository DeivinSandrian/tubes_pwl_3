@extends('layouts.auth')

@section('title', 'Register')

@section('content')
    <h3 class="card-title text-left mb-3">Register an Admin Account</h3>
    <h6 class="fw-light">Fill in the details to get started.</h6>
    @if (session('status'))
        <div class="alert alert-success mb-4">
            {{ session('status') }}
        </div>
    @endif

    <form class="pt-3" method="POST" action="{{ route('admin.register') }}">
        @csrf

        <input type="hidden" name="program_studi_id_prodi" value="1">

        <!-- Nama -->
        <div class="form-group">
            <input type="text" name="nama" id="nama" class="form-control form-control-lg @error('nama') is-invalid @enderror" placeholder="Nama" value="{{ old('nama') }}" required autofocus>
            @error('nama')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <!-- Email -->
        <div class="form-group">
            <input type="email" name="email" id="email" class="form-control form-control-lg @error('email') is-invalid @enderror" placeholder="Email" value="{{ old('email') }}" required>
            @error('email')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <!-- Password -->
        <div class="form-group">
            <input type="password" name="password" id="password" class="form-control form-control-lg @error('password') is-invalid @enderror" placeholder="Password" required>
            @error('password')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <!-- Password Confirmation -->
        <div class="form-group">
            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control form-control-lg" placeholder="Confirm Password" required>
        </div>

        <!-- Role -->
        <!-- <div class="form-group">
            <select name="role" id="role" class="form-control form-control-lg @error('role') is-invalid @enderror" required>
                <option value="" disabled selected>Select Role</option>
                <option value="admin">Admin</option>
            </select>
            @error('role')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div> -->

        <!-- Program Studi -->
        <!-- <div class="form-group">
            <select name="program_studi_id_prodi" id="program_studi_id_prodi" class="form-control form-control-lg @error('program_studi_id_prodi') is-invalid @enderror" required>
                <option value="" disabled selected>Select Program Studi</option>
                @if (isset($programStudis) && $programStudis->isNotEmpty())
                    @foreach ($programStudis as $programStudi)
                        <option value="{{ $programStudi->id_prodi }}">{{ $programStudi->nama_prodi }}</option>
                    @endforeach
                @else
                    <option value="" disabled>No Program Studi available</option>
                    <option value="si" enabled>Sistem Informasi</option>
                @endif
            </select>
            @error('program_studi_id_prodi')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div> -->

        <div class="mt-3">
            <button type="submit" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn">Register</button>
        </div>
 
        <div class="text-center mt-4 fw-light">
            Already have an account? <a href="{{ route('login') }}" class="text-primary">Login here</a>
        </div>
    </form>
@endsection