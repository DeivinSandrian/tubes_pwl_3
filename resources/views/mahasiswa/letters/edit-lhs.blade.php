@extends('layouts.app')

@section('title', 'Edit Laporan Hasil Studi')

@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Edit Laporan Hasil Studi (LHS)</h4>

                        @if (session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif

                        <form method="POST" action="{{ route('mahasiswa.letters.update', $surat->id_surat) }}">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="jenis_surat" value="LHS">

                            <div class="form-group">
                                <label for="keperluan_pengajuan">Keperluan Pembuatan LHS *</label>
                                <textarea name="keperluan_pengajuan" id="keperluan_pengajuan"
                                          class="form-control @error('keperluan_pengajuan') is-invalid @enderror"
                                          rows="3" required>{{ old('keperluan_pengajuan', $surat->keperluan_pengajuan) }}</textarea>
                                @error('keperluan_pengajuan')
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
