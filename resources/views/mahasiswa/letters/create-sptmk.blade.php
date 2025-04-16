@extends('layouts.app')

@section('title', 'Create Surat Pengantar Tugas Mata Kuliah')

@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-md-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Create Surat Pengantar Tugas Mata Kuliah</h4>
                            @if (session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif
                            <form method="POST" action="{{ route('mahasiswa.letters.store') }}">
                                @csrf
                                <input type="hidden" name="jenis_surat" value="SPTMK">
                                <div class="form-group">
                                    <label for="surat_ditujukan_kepada">Surat Ditujukan Kepada *</label>
                                    <textarea name="surat_ditujukan_kepada" id="surat_ditujukan_kepada" class="form-control @error('surat_ditujukan_kepada') is-invalid @enderror" rows="3" required>{{ old('surat_ditujukan_kepada') }}</textarea>
                                    <small>Informasikan secara lengkap: nama, jabatan, nama perusahaan, dan alamat perusahaan (contoh: Ibu Susi Susanti, Kepala Personalia PT. X, Jln. Cibogo no. 10, Bandung)</small>
                                    @error('surat_ditujukan_kepada')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="nama_mata_kuliah">Nama Mata Kuliah *</label>
                                    <input type="text" name="nama_mata_kuliah" id="nama_mata_kuliah" class="form-control @error('nama_mata_kuliah') is-invalid @enderror" value="{{ old('nama_mata_kuliah') }}" placeholder="Contoh: Proses Bisnis" required>
                                    @error('nama_mata_kuliah')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                    <input type="hidden" name="nama_mata_kuliah2" value="{{ old('nama_mata_kuliah') }}">
                                </div>
                                <div class="form-group">
                                    <label for="kode_mata_kuliah">Kode Mata Kuliah *</label>
                                    <input type="text" name="kode_mata_kuliah" id="kode_mata_kuliah" class="form-control @error('kode_mata_kuliah') is-invalid @enderror" value="{{ old('kode_mata_kuliah') }}" placeholder="Contoh: IN255" required>
                                    @error('kode_mata_kuliah')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                    <input type="hidden" name="kode_mata_kuliah2" value="{{ old('kode_mata_kuliah') }}">
                                </div>
                                <div class="form-group">
                                    <label for="semester">Semester *</label>
                                    <select name="semester" id="semester" class="form-control @error('semester') is-invalid @enderror" required>
                                        <option value="" disabled selected>Pilih semester yang ditempuh saat ini</option>
                                        @for ($i = 1; $i <= 14; $i++)
                                            <option value="{{ $i }}" {{ old('semester') == $i ? 'selected' : '' }}>Semester {{ $i }}</option>
                                        @endfor
                                    </select>
                                    @error('semester')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="data_mahasiswa">Data Mahasiswa *</label>
                                    <textarea name="data_mahasiswa" id="data_mahasiswa" class="form-control @error('data_mahasiswa') is-invalid @enderror" rows="3" required>{{ old('data_mahasiswa') }}</textarea>
                                    <small>Informasikan nama dan NRP tiap mahasiswa (contoh: Mahasiswa 1 - 15720xx; Mahasiswa 2 - 15720xx; dst)</small>
                                    @error('data_mahasiswa')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="keperluan_pengajuan">Keperluan Pengajuan *</label>
                                    <textarea name="keperluan_pengajuan" id="keperluan_pengajuan" class="form-control @error('keperluan_pengajuan') is-invalid @enderror" rows="3" required>{{ old('keperluan_pengajuan') }}</textarea>
                                    @error('keperluan_pengajuan')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="topik">Topik *</label>
                                    <textarea name="topik" id="topik" class="form-control @error('topik') is-invalid @enderror" rows="3" required>{{ old('topik') }}</textarea>
                                    @error('topik')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <button type="submit" class="btn btn-primary">Submit Request</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection