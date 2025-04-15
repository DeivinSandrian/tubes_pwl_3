@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Create Letter</h2>
    <div class="card">
        <div class="card-body">
            <p><strong>Jenis Surat:</strong> {{ $surat->jenis_surat }}</p>
            <p><strong>Nama Mahasiswa:</strong> {{ $surat->user->nama }}</p>
            <p><strong>Nomor Surat:</strong> {{ $letterNumber }}</p>
            <p><strong>Tanggal Surat:</strong> {{ $letterDate }}</p>
        </div>
    </div>
    <form method="POST" action="{{ route('tata_usaha.store_letter') }}">
        @csrf
        <input type="hidden" name="surat_id" value="{{ $surat->id_surat }}">
        <button type="submit" class="btn btn-primary">Proceed to Upload</button>
    </form>
</div>
@endsection