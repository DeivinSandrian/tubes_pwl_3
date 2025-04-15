@extends('layouts.app')

@section('title', 'Letter Requests')

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
                                    <h4 class="card-title">Letter Requests</h4>
                                    @if (session('success'))
                                        <div class="alert alert-success">
                                            {{ session('success') }}
                                        </div>
                                    @endif
                                    @if ($pengajuans->isEmpty())
                                        <p>No letter requests found.</p>
                                    @else
                                        <div class="table-responsive">
                                            <table class="table table-striped">
                                                <thead>
                                                    <tr>
                                                        <th>Student Name</th>
                                                        <th>Letter Type</th>
                                                        <th>Description</th>
                                                        <th>Status</th>
                                                        <th>Submission Date</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($pengajuans as $pengajuan)
                                                        <tr>
                                                            <td>{{ $pengajuan->user->nama }}</td>
                                                            <td>{{ $pengajuan->surat->nama_surat }}</td>
                                                            <td>{{ $pengajuan->keterangan }}</td>
                                                            <td>{{ ucfirst($pengajuan->status) }}</td>
                                                            <td>{{ $pengajuan->created_at->format('d M Y') }}</td>
                                                            <td>
                                                                @if ($pengajuan->status === 'approved')
                                                                    <form action="{{ route('tatausaha.letters.upload', $pengajuan->id_pengajuan) }}" method="POST" enctype="multipart/form-data">
                                                                        @csrf
                                                                        <div class="form-group">
                                                                            <input type="file" name="file" class="form-control-file @error('file') is-invalid @enderror" required>
                                                                            @error('file')
                                                                                <span class="text-danger">{{ $message }}</span>
                                                                            @enderror
                                                                        </div>
                                                                        <button type="submit" class="btn btn-sm btn-primary">Upload Document</button>
                                                                    </form>
                                                                @elseif ($pengajuan->status === 'completed')
                                                                    <span class="text-success">Document Uploaded</span>
                                                                @else
                                                                    <span class="text-muted">{{ ucfirst($pengajuan->status) }}</span>
                                                                @endif
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