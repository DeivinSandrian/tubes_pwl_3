@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Daftar Pengajuan Surat</h2>
    
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Jenis Surat</th>
                    <th>Mahasiswa</th>
                    <th>Tanggal Pengajuan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($letters as $index => $letter)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ ucfirst($letter->jenis_surat) }}</td>
                        <td>{{ $letter->user->name }}</td>
                        <td>{{ $letter->created_at->format('d/m/Y') }}</td>
                        <td>
                            <a href="{{ route('ketua.approve.form', $letter->id_surat) }}" 
                               class="btn btn-sm btn-primary">
                                Proses
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center">Tidak ada pengajuan surat</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection