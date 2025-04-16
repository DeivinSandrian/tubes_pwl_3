@extends('layouts.app')

@section('title', 'Create Laporan Hasil Studi')

@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-md-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Create Laporan Hasil Studi</h4>
                            @if (session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif
                            <form method="POST" action="{{ route('mahasiswa.letters.store') }}">
                                @csrf
                                <input type="hidden" name="jenis_surat" value="LHS">
                                <!-- <div class="form-group">
                                    <label for="nama_lengkap">Nama Lengkap *</label>
                                    <input type="text" name="nama_lengkap" id="nama_lengkap" class="form-control @error('nama_lengkap') is-invalid @enderror" value="{{ old('nama_lengkap') }}" required>
                                    <small>Isikan dengan nama lengkap dalam format HURUF BESAR - Huruf Kecil (contoh: Susi Susanti)</small>
                                    @error('nama_lengkap')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div> -->
                                <!-- <div class="form-group">
                                    <label for="nrp">NRP *</label>
                                    <input type="text" name="nrp" id="nrp" class="form-control @error('nrp') is-invalid @enderror" value="{{ old('nrp') }}" required>
                                    @error('nrp')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div> -->
                                <div class="form-group">
                                    <label for="keperluan_pengajuan">Keperluan Pembuatan LHS *</label>
                                    <textarea name="keperluan_pengajuan" id="keperluan_pengajuan" class="form-control @error('keperluan_pengajuan') is-invalid @enderror" rows="3" required>{{ old('keperluan_pengajuan') }}</textarea>
                                    @error('keperluan_pengajuan')
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