@extends('layouts.app')

@section('title', 'Mahasiswa Dashboard')

@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-md-12 grid-margin">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Welcome, {{ Auth::user()->nama }}!</h4>
                            <p class="card-description">Your Letter Requests</p>
                            @if ($surats->isEmpty())
                                <p>No letter requests found.</p>
                            @else
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>Letter Type</th>
                                                <th>Status</th>
                                                <th>Submission Date</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($surats as $surat)
                                                <tr>
                                                    <td>{{ $surat->jenis_surat }}</td>
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
                                                    <td>{{ $surat->created_at->format('d M Y') }}</td>
                                                    <td>
                                                        <a href="{{ route('mahasiswa.letters.show', $surat->id_surat) }}" class="btn btn-sm btn-primary">View</a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection