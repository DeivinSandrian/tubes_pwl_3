@extends('layouts.app')

@section('title', 'Edit Surat Keterangan Lulus')

@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Edit Surat Keterangan Lulus</h4>
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
                        <form method="POST" action="{{ route('mahasiswa.letters.update', $surat->id_surat) }}">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="jenis_surat" value="SKT">
                            <div class="form-group">
                                <label for="tanggal_kelulusan">Tanggal Kelulusan *</label>
                                <input type="date" name="tanggal_kelulusan" id="tanggal_kelulusan" class="form-control @error('tanggal_kelulusan') is-invalid @enderror" value="{{ old('tanggal_kelulusan', $surat->tanggal_kelulusan) }}" required>
                                @error('tanggal_kelulusan')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary">Update Surat</button>
                            <a href="{{ route('mahasiswa.letters.show', $surat->id_surat) }}" class="btn btn-secondary ml-2">Batal</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
