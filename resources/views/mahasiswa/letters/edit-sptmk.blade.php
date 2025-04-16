@extends('layouts.app')

@section('title', 'Edit Surat Pengantar Tugas Mata Kuliah')

@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Edit Surat Pengantar Tugas Mata Kuliah</h4>
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
                        <form method="POST" action="{{ route('mahasiswa.letters.update', $surat->id_surat) }}">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="jenis_surat" value="SPTMK">
                            <div class="form-group">
                                <label for="surat_ditujukan_kepada">Surat Ditujukan Kepada *</label>
                                <textarea name="surat_ditujukan_kepada" id="surat_ditujukan_kepada" class="form-control @error('surat_ditujukan_kepada') is-invalid @enderror" rows="3" required>{{ old('surat_ditujukan_kepada', $surat->surat_ditujukan_kepada) }}</textarea>
                                @error('surat_ditujukan_kepada')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="nama_mata_kuliah">Nama Mata Kuliah *</label>
                                <input type="text" name="nama_mata_kuliah" id="nama_mata_kuliah" class="form-control @error('nama_mata_kuliah') is-invalid @enderror" value="{{ old('nama_mata_kuliah', $surat->nama_mata_kuliah) }}" required>
                                @error('nama_mata_kuliah')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="kode_mata_kuliah">Kode Mata Kuliah *</label>
                                <input type="text" name="kode_mata_kuliah" id="kode_mata_kuliah" class="form-control @error('kode_mata_kuliah') is-invalid @enderror" value="{{ old('kode_mata_kuliah', $surat->kode_mata_kuliah) }}" required>
                                @error('kode_mata_kuliah')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="semester">Semester *</label>
                                <select name="semester" id="semester" class="form-control @error('semester') is-invalid @enderror" required>
                                    @for ($i = 1; $i <= 14; $i++)
                                        <option value="{{ $i }}" {{ old('semester', $surat->semester) == $i ? 'selected' : '' }}>Semester {{ $i }}</option>
                                    @endfor
                                </select>
                                @error('semester')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="data_mahasiswa">Data Mahasiswa *</label>
                                <textarea name="data_mahasiswa" id="data_mahasiswa" class="form-control @error('data_mahasiswa') is-invalid @enderror" rows="3" required>{{ old('data_mahasiswa', $surat->data_mahasiswa) }}</textarea>
                                @error('data_mahasiswa')
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
                            <div class="form-group">
                                <label for="topik">Topik *</label>
                                <textarea name="topik" id="topik" class="form-control @error('topik') is-invalid @enderror" rows="3" required>{{ old('topik', $surat->topik) }}</textarea>
                                @error('topik')
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
