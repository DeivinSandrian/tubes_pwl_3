@extends('layouts.app')

@section('title', 'Edit User')

@section('content')
            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="row">
                        <div class="col-md-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Edit User</h4>
                                    <form method="POST" action="{{ route('admin.users.update', $user->id_user) }}">
                                        @csrf
                                        @method('PUT')
                                        <div class="form-group">
                                            <label for="nama">Name</label>
                                            <input type="text" name="nama" id="nama" class="form-control @error('nama') is-invalid @enderror" value="{{ old('nama', $user->nama) }}" required>
                                            @error('nama')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="email">Email</label>
                                            <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $user->email) }}" required>
                                            @error('email')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="password">Password (Leave blank to keep unchanged)</label>
                                            <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror">
                                            @error('password')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="role">Role</label>
                                            <select name="role" id="role" class="form-control @error('role') is-invalid @enderror" required>
                                                <option value="" disabled>Select Role</option>
                                                <option value="mahasiswa" {{ $user->role == 'mahasiswa' ? 'selected' : '' }}>Mahasiswa</option>
                                                <option value="ketua" {{ $user->role == 'ketua' ? 'selected' : '' }}>Ketua (Kaprodi)</option>
                                                <option value="tatausaha" {{ $user->role == 'tatausaha' ? 'selected' : '' }}>Tata Usaha</option>
                                            </select>
                                            @error('role')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="program_studi_id_prodi">Program Studi</label>
                                            <select name="program_studi_id_prodi" id="program_studi_id_prodi" class="form-control @error('program_studi_id_prodi') is-invalid @enderror" required>
                                                <option value="" disabled>Select Program Studi</option>
                                                @foreach ($programStudis as $programStudi)
                                                    <option value="{{ $programStudi->id_prodi }}" {{ $programStudi->id_prodi == $user->program_studi_id_prodi ? 'selected' : '' }}>
                                                        {{ $programStudi->nama_prodi }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('program_studi_id_prodi')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <button type="submit" class="btn btn-primary">Update</button>
                                        <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">Cancel</a>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
@endsection