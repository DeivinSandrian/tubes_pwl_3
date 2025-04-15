@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Persetujuan Surat</h2>
    
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Detail Surat</h5>
            <p><strong>Jenis Surat:</strong> {{ ucfirst($letter->jenis_surat) }}</p>
            <p><strong>Mahasiswa:</strong> {{ $letter->user->name }}</p>
            <p><strong>Program Studi:</strong> {{ $letter->user->programStudi->name_prod }}</p>
            <p><strong>Tanggal Pengajuan:</strong> {{ $letter->created_at->format('d/m/Y H:i') }}</p>
            
            @if($letter->detail)
                <p><strong>Alasan Pengajuan:</strong> {{ $letter->detail->alasan_pengajuan }}</p>
            @endif
        </div>
    </div>

    <div class="mt-4">
        <form action="{{ route('ketua.approve', $letter->id_surat) }}" method="POST" class="d-inline">
            @csrf
            <button type="submit" class="btn btn-success">Setujui</button>
        </form>
        
        <form action="{{ route('ketua.reject', $letter->id_surat) }}" method="POST" class="d-inline">
            @csrf
            <button type="submit" class="btn btn-danger">Tolak</button>
        </form>
        
        <a href="{{ route('ketua.dashboard') }}" class="btn btn-secondary">Kembali</a>
    </div>
</div>
@endsection