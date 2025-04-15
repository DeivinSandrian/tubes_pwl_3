@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Tata Usaha Dashboard</h2>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <table class="table table-dark">
        <thead>
            <tr>
                <th>Jenis Surat</th>
                <th>Nama Mahasiswa</th>
                <th>Status Pengajuan</th>
                <th>Status Upload</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($surat as $s)
                <tr>
                    <td>{{ $s->jenis_surat }}</td>
                    <td>{{ $s->user->nama }}</td>
                    <td>{{ $s->status_pengajuan }}</td>
                    <td>{{ $s->upload_surat ? $s->upload_surat->status_upload : 'pending' }}</td>
                    <td>
                        @if(!$s->upload_surat || $s->upload_surat->status_upload !== 'uploaded')
                            <a href="{{ route('tata_usaha.create_letter', $s->id_surat) }}" class="btn btn-primary btn-sm">Proses</a>
                        @else
                            <span class="text-muted">Uploaded</span>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection