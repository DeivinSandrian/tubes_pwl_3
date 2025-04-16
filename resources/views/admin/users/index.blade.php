@extends('layouts.app')

@section('title', 'Manage Users')

@section('content')
            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="row">
                        <div class="col-md-12 grid-margin">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Manage Users</h4>
                                    <a href="{{ route('admin.users.create') }}" class="btn btn-primary mb-3">Add User</a>
                                    @if (session('success'))
                                        <div class="alert alert-success">
                                            {{ session('success') }}
                                        </div>
                                    @endif
                                    @if ($users->isEmpty())
                                        <p>No users found.</p>
                                    @else
                                        <div class="table-responsive">
                                            <table class="table table-striped">
                                                <thead>
                                                    <tr>
                                                        <th>Name</th>
                                                        <th>Email</th>
                                                        <th>Role</th>
                                                        <th>Program Studi</th>
                                                        <th>Actions</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($users as $user)
                                                        <tr>
                                                            <td>{{ $user->nama }}</td>
                                                            <td>{{ $user->email }}</td>
                                                            <td>{{ ucfirst($user->role) }}</td>
                                                            <td>{{ $user->programStudi->nama_prodi ?? 'N/A' }}</td>
                                                            <td>
                                                                <a href="{{ route('admin.users.edit', $user->id_user) }}" class="btn btn-sm btn-warning">Edit</a>
                                                                <form action="{{ route('admin.users.destroy', $user->id_user) }}" method="POST" style="display:inline;">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                                                                </form>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
@endsection