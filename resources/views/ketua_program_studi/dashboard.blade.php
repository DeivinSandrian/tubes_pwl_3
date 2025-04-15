@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Ketua Program Studi Dashboard</h2>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <table class="table table-dark">
        <thead>
            <tr>
                <th>Jenis Surat</th>
                <th>Nama Mahasiswa</th>
                <th>Status Pengajuan</th>
                <th>Tanggal Pengajuan</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($surat as $s)
                <tr>
                    <td>{{ $s->jenis_surat }}</td>
                    <td>{{ $s->user->nama }}</td>
                    <td>{{ $s->status_pengajuan }}</td>
                    <td>{{ $s->tanggal_pengajuan }}</td>
                    <td>
                        @if(!$s->persetujuan)
                            <a href="{{ route('ketua_program_studi.approve_letter', $s->id_surat) }}" class="btn btn-primary btn-sm">Proses</a>
                        @else
                            <span class="text-muted">Processed</span>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection