@extends('layouts.app')

@section('content')
<div class="container-fluid page-body-wrapper">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">My Letters</h4>
                        @if (session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif
                        @if (session('error'))
                            <div class="alert alert-danger">{{ session('error') }}</div>
                        @endif
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Type</th>
                                    <th>Reason</th>
                                    <th>Status</th>
                                    <th>Submission Date</th>
                                    <th>Approval Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($surats as $surat)
                                    <tr>
                                        <td>{{ str_replace('_', ' ', $surat->jens_surat) }}</td>
                                        <td>{{ $surat->detail->alasan_pengajuan }}</td>
                                        <td>{{ $surat->status_pengajuan }}</td>
                                        <td>{{ $surat->tanggal_pengajuan->format('Y-m-d') }}</td>
                                        <td>{{ $surat->tanggal_persetujuan ? $surat->tanggal_persetujuan->format('Y-m-d') : '-' }}</td>
                                        <td>
                                            @if ($surat->upload && $surat->upload->status_upload === 'uploaded')
                                                <a href="{{ route('mahasiswa.download_letter', $surat->id_surat) }}" class="btn btn-primary btn-sm">Download</a>
                                            @else
                                                <span class="text-muted">Not Available</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection