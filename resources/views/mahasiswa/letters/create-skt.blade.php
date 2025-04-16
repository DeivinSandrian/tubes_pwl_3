@extends('layouts.app')

@section('title', 'Create Surat Keterangan Lulus')

@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-md-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Create Surat Keterangan Lulus</h4>
                            @if (session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif
                            <form method="POST" action="{{ route('mahasiswa.letters.store') }}">
                                @csrf
                                <input type="hidden" name="jenis_surat" value="SKT">
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
                                    <label for="tanggal_kelulusan">Tanggal Kelulusan *</label>
                                    <input type="date" name="tanggal_kelulusan" id="tanggal_kelulusan" class="form-control @error('tanggal_kelulusan') is-invalid @enderror" value="{{ old('tanggal_kelulusan') }}" required>
                                    @error('tanggal_kelulusan')
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