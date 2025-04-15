@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Submit Letter Request</h2>
    <form method="POST" action="{{ route('mahasiswa.submit_letter') }}">
        @csrf
        <div class="form-group mb-3">
            <label for="jenis_surat">Jenis Surat</label>
            <select name="jenis_surat" class="form-control" required>
                <option value="surat keterangan mahasiswa aktif">Surat Keterangan Mahasiswa Aktif</option>
                <option value="surat pengantar tugas mata kuliah">Surat Pengantar Tugas Mata Kuliah</option>
                <option value="surat keterangan lulus">Surat Keterangan Lulus</option>
                <option value="laporan hasil studi">Laporan Hasil Studi</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
@endsection