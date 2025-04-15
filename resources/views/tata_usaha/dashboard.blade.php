@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Daftar Surat Disetujui</h2>
    
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
                    <th>Tanggal Disetujui</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($letters as $index => $letter)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ ucfirst($letter->jenis_surat) }}</td>
                        <td>{{ $letter->user->name }}</td>
                        <td>{{ $letter->tanggal_persetujuan->format('d/m/Y') }}</td>
                        <td>
                            @if($letter->uploadSurat)
                                <span class="badge bg-success">Selesai</span>
                            @else
                                <span class="badge bg-warning text-dark">Menunggu Upload</span>
                            @endif
                        </td>
                        <td>
                            @if(!$letter->uploadSurat)
                                <a href="{{ route('tata_usaha.create.form', $letter->id_surat) }}" 
                                   class="btn btn-sm btn-primary">
                                    Buat Surat
                                </a>
                            @else
                                <a href="{{ Storage::url($letter->uploadSurat->file_surat) }}" 
                                   target="_blank" 
                                   class="btn btn-sm btn-success">
                                    Lihat Surat
                                </a>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">Tidak ada surat yang perlu diproses</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection