@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Buat Surat Keterangan</h2>
    
    <div class="card mb-4">
        <div class="card-body">
            <h5 class="card-title">Data Pengajuan</h5>
            <p><strong>No. Surat:</strong> {{ $letterNumber }}</p>
            <p><strong>Tanggal:</strong> {{ $letterDate }}</p>
            <p><strong>Jenis Surat:</strong> {{ ucfirst($letter->jenis_surat) }}</p>
            <p><strong>Mahasiswa:</strong> {{ $letter->user->name }}</p>
            <p><strong>NIM:</strong> {{ $letter->user->nim ?? '-' }}</p>
            <p><strong>Program Studi:</strong> {{ $letter->user->programStudi->name_prod }}</p>
        </div>
    </div>

    <form action="{{ route('tata_usaha.upload', $letter->id_surat) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="file_surat" class="form-label">Upload Surat (PDF)</label>
            <input type="file" class="form-control" id="file_surat" name="file_surat" accept=".pdf" required>
        </div>
        
        <button type="submit" class="btn btn-primary">Upload Surat</button>
        <a href="{{ route('tata_usaha.dashboard') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection