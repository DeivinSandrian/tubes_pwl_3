@extends('layouts.app')

@section('title', 'Letter Request Details')

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
                                    <h4 class="card-title">Letter Request Details</h4>
                                    <div class="table-responsive">
                                        <table class="table">
                                            <tr>
                                                <th>Letter Type</th>
                                                <td>{{ $pengajuan->surat->nama_surat }}</td>
                                            </tr>
                                            <tr>
                                                <th>Description</th>
                                                <td>{{ $pengajuan->keterangan }}</td>
                                            </tr>
                                            <tr>
                                                <th>Status</th>
                                                <td>{{ ucfirst($pengajuan->status) }}</td>
                                            </tr>
                                            <tr>
                                                <th>Submission Date</th>
                                                <td>{{ $pengajuan->created_at->format('d M Y') }}</td>
                                            </tr>
                                            @if ($pengajuan->status === 'completed')
                                                <tr>
                                                    <th>Download Letter</th>
                                                    <td>
                                                        @if ($pengajuan->detailSurat && $pengajuan->detailSurat->file_path)
                                                            <a href="{{ asset('storage/' . $pengajuan->detailSurat->file_path) }}" class="btn btn-sm btn-success" download>Download</a>
                                                        @else
                                                            <span class="text-muted">Not available</span>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endif
                                        </table>
                                    </div>
                                    <a href="{{ route('mahasiswa.letters') }}" class="btn btn-secondary mt-3">Back to Letters</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection