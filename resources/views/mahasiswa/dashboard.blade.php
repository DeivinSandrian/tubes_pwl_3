@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Mahasiswa Dashboard</h2>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif
    <table class="table table-dark">
        <thead>
            <tr>
                <th>Jenis Surat</th>
                <th>Status Pengajuan</th>
                <th>Tanggal Pengajuan</th>
                <th>Tanggal Persetujuan</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($surat as $s)
                <tr>
                    <td>{{ $s->jenis_surat }}</td>
                    <td>{{ $s->status_pengajuan }}</td>
                    <td>{{ $s->tanggal_pengajuan }}</td>
                    <td>{{ $s->tanggal_persetujuan ?? 'N/A' }}</td>
                    <td>
                        @if($s->upload_surat && $s->upload_surat->status_upload === 'uploaded')
                            <a href="{{ route('mahasiswa.download_letter', $s->id_surat) }}" class="btn btn-success btn-sm">Download</a>
                        @else
                            <span class="text-muted">Not available</span>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection