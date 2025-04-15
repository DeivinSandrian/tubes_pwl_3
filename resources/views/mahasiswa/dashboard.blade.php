@extends('layouts.app')

@section('title', 'Mahasiswa Dashboard')

@section('content')
    <div class="container-scroller">
        <div class="container-fluid page-body-wrapper">
            @include('layouts.sidebar')
            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="row">
                        <div class="col-md-12 grid-margin">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Welcome, {{ Auth::user()->nama }}!</h4>
                                    <p class="card-description">Your Letter Requests</p>
                                    @if ($pengajuans->isEmpty())
                                        <p>No letter requests found.</p>
                                    @else
                                        <div class="table-responsive">
                                            <table class="table table-striped">
                                                <thead>
                                                    <tr>
                                                        <th>Letter Type</th>
                                                        <th>Status</th>
                                                        <th>Submission Date</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($pengajuans as $pengajuan)
                                                        <tr>
                                                            <td>{{ $pengajuan->surat->nama_surat }}</td>
                                                            <td>{{ ucfirst($pengajuan->status) }}</td>
                                                            <td>{{ $pengajuan->created_at->format('d M Y') }}</td>
                                                            <td>
                                                                <a href="{{ route('mahasiswa.letters.show', $pengajuan->id_pengajuan) }}" class="btn btn-sm btn-primary">View</a>
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
        </div>
    </div>
@endsection