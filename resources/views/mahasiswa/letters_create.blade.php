@extends('layouts.app')

@section('title', 'Create Letter Request')

@section('content')
    <div class="container-scroller">
        <div class="container-fluid page-body-wrapper">
            @include('layouts.sidebar')
            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="row">
                        <div class="col-md-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Create Letter Request</h4>
                                    @if (session('success'))
                                        <div class="alert alert-success">
                                            {{ session('success') }}
                                        </div>
                                    @endif
                                    <form method="POST" action="{{ route('mahasiswa.letters.store') }}">
                                        @csrf
                                        <div class="form-group">
                                            <label for="surat_id_surat">Letter Type</label>
                                            <select name="surat_id_surat" id="surat_id_surat" class="form-control @error('surat_id_surat') is-invalid @enderror" required>
                                                <option value="" disabled selected>Select Letter Type</option>
                                                @foreach ($surats as $surat)
                                                    <option value="{{ $surat->id_surat }}">{{ $surat->nama_surat }}</option>
                                                @endforeach
                                            </select>
                                            @error('surat_id_surat')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="keterangan">Description</label>
                                            <textarea name="keterangan" id="keterangan" class="form-control @error('keterangan') is-invalid @enderror" rows="5" required>{{ old('keterangan') }}</textarea>
                                            @error('keterangan')
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
        </div>
    </div>
@endsection 