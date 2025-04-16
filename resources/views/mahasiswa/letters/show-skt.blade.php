@extends('layouts.app')

@section('title', 'Detail Surat SKT')

@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12 grid-margin">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Detail Surat Keterangan Lulus (SKT)</h4>
                        <table class="table table-bordered">
                            <tr><th>Nama Lengkap</th><td>{{ $surat->user->nama }}</td></tr>
                            <!-- <tr><th>NRP</th><td>{{ Auth::user()->nrp }}</td></tr> -->
                            <tr><th>Tanggal Kelulusan</th><td>{{ \Carbon\Carbon::parse($surat->tanggal_kelulusan)->format('d M Y') }}</td></tr>
                            <tr><th>Status</th><td>@if ($surat->status_pengajuan == 'pending')
                                                            <button type="button" class="btn btn-outline-warning btn-fw">{{ ucfirst($surat->status_pengajuan) }}</button>
                                                        @elseif ($surat->status_pengajuan == 'approved')
                                                            <button type="button" class="btn btn-outline-success btn-fw">{{ ucfirst($surat->status_pengajuan) }}</button>
                                                        @elseif ($surat->status_pengajuan == 'rejected')
                                                            <button type="button" class="btn btn-outline-danger btn-fw">{{ ucfirst($surat->status_pengajuan) }}</button>
                                                        @elseif ($surat->status_pengajuan == 'completed')
                                                            <button type="button" class="btn btn-outline-primary btn-fw">{{ ucfirst($surat->status_pengajuan) }}</button>
                                                        @else
                                                            <button type="button" class="btn btn-outline-secondary btn-fw">{{ ucfirst($surat->status_pengajuan) }}</button>
                                                        @endif</td>
                                                        <!-- <td>{{ ucfirst($surat->status_pengajuan) }}</td> -->
                                                    </tr>
                            <tr><th>Tanggal Pengajuan</th><td>{{ $surat->created_at->format('d M Y') }}</td></tr>
                        </table>
                        <!-- Hanya Untuk Ketua -->
                        @if (Auth::user()->role === 'ketua' && $surat->status_pengajuan === 'pending')
                            <div class="mt-4">
                                <form action="{{ route('ketua.letters.approve', $surat->id_surat) }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-primary mr-2">Setujui</button>
                                </form>
                                <form action="{{ route('ketua.letters.reject', $surat->id_surat) }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-danger">Tolak</button>
                                </form>
                            </div>
                        @endif
                        <!-- Untuk Download Surat -->
                        @if ($surat->file_path)
                            <a href="{{ route('mahasiswa.letters.download', $surat->id_surat) }}" class="btn btn-success mt-3" target="_blank">
                                <i class="mdi mdi-download"></i> Download Surat
                            </a>
                        @else
                            @if ($surat->user_id_user === Auth::user()->id_user)
                                <p class="text-muted mt-3">Belum ada file yang diunggah oleh Tata Usaha.</p>
                            @endif
                        @endif
                        <!-- Untuk Upload Surat Khusus TU -->
                        @if (Auth::user()->role === 'tatausaha')
                            <form action="{{ route('tatausaha.letters.upload', $surat->id_surat) }}" method="POST" enctype="multipart/form-data" class="mt-3">
                                @csrf
                                <div class="form-group">
                                    <label for="file_path">Upload File Surat (PDF)</label>
                                    <input type="file" name="file_path" class="form-control" accept="application/pdf" required>
                                </div>
                                <button type="submit" class="btn btn-primary mt-2"><i class="mdi mdi-upload">Upload</i></button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
