@extends('layouts.app')

@section('title', 'Dashboard Ketua Program Studi')

@section('content')

        <div class="main-panel">
            <div class="content-wrapper">
                <div class="row">
                    <div class="col-lg-12 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Daftar Surat Pengajuan</h4>
                                <p class="card-description">Daftar surat yang diajukan</p>
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Jenis Surat</th>
                                                <th>Nama Mahasiswa</th>
                                                <th>Tanggal Pengajuan</th>
                                                <th>Status</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($surats as $index => $surat)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>{{ $surat->jenis_surat ?? 'Tidak Tersedia' }}</td>
                                                <td>{{ $surat->user->nama ?? 'Tidak Tersedia' }}</td>
                                                <td>{{ $surat->created_at->format('d M Y') }}</td>
                                                <td>@if ($surat->status_pengajuan == 'pending')
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
                                                <td>
                                                    <a href="{{ route('ketua.letters.show', $surat->id_surat) }}" class="btn btn-sm btn-primary">View</a>
                                                </td>
                                            </tr>
                                            @empty
                                            <tr>
                                                <td colspan="5" class="text-center">Belum ada surat yang diajukan.</td>
                                            </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

@endsection