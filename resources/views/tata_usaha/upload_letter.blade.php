@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Upload Letter</h2>
    <div class="card">
        <div class="card-body">
            <p><strong>Jenis Surat:</strong> {{ $surat->jenis_surat }}</p>
            <p><strong>Nama Mahasiswa:</strong> {{ $surat->user->nama }}</p>
        </div>
    </div>
    <form method="POST" action="{{ route('tata_usaha.upload_letter') }}" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="surat_id" value="{{ $surat->id_surat }}">
        <div class="form-group mb-3">
            <label for="file_surat">Upload File (PDF)</label>
            <input type="file" name="file_surat" class="form-control" accept=".pdf" required>
            @error('file_surat')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Upload</button>
    </form>
</div>
@endsection