@extends('layouts.app')

@section('title', 'Edit Surat Keterangan Mahasiswa Aktif')

@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Edit Surat Keterangan Mahasiswa Aktif</h4>
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
                        <form method="POST" action="{{ route('mahasiswa.letters.update', $surat->id_surat) }}">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="jenis_surat" value="SKMA">
                            <div class="form-group">
                                <label for="semester">Semester *</label>
                                <select name="semester" id="semester" class="form-control @error('semester') is-invalid @enderror" required>
                                    <option value="" disabled>Pilih semester</option>
                                    @for ($i = 1; $i <= 14; $i++)
                                        <option value="{{ $i }}" {{ old('semester', $surat->semester) == $i ? 'selected' : '' }}>Semester {{ $i }}</option>
                                    @endfor
                                </select>
                                @error('semester')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="alamat_lengkap_bandung">Alamat Lengkap Mahasiswa di Bandung *</label>
                                <textarea name="alamat_lengkap_bandung" id="alamat_lengkap_bandung" class="form-control @error('alamat_lengkap_bandung') is-invalid @enderror" rows="3" required>{{ old('alamat_lengkap_bandung', $surat->alamat_lengkap_bandung) }}</textarea>
                                @error('alamat_lengkap_bandung')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="keperluan_pengajuan">Keperluan Pengajuan *</label>
                                <textarea name="keperluan_pengajuan" id="keperluan_pengajuan" class="form-control @error('keperluan_pengajuan') is-invalid @enderror" rows="3" required>{{ old('keperluan_pengajuan', $surat->keperluan_pengajuan) }}</textarea>
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