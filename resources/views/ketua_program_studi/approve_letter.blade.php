@extends('layouts.app')

@section('content')
<div class="container-fluid page-body-wrapper">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-lg-6 mx-auto">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Approve Letter Request</h4>
                        @if (session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif
                        <p><strong>Type:</strong> {{ str_replace('_', ' ', $letter->jens_surat) }}</p>
                        <p><strong>Reason:</strong> {{ $letter->detail->alasan_pengajuan }}</p>
                        <p><strong>Student:</strong> {{ $letter->user->nama }}</p>
                        <p><strong>Program Studi:</strong> {{ $letter->user->programStudi->nama_prodi }}</p>
                        <p><strong>Status:</strong> {{ $letter->status_pengajuan }}</p>
                        <form method="POST" action="{{ route('ketua.store_approval', $letter->id_surat) }}" style="display:inline;">
                            @csrf
                            <button type="submit" class="btn btn-success btn-block">Approve</button>
                        </form>
                        <form method="POST" action="{{ route('ketua.reject_letter', $letter->id_surat) }}" style="display:inline;">
                            @csrf
                            <button type="submit" class="btn btn-danger btn-block">Reject</button>
                        </form>
                        <a href="{{ route('ketua.dashboard') }}" class="btn btn-secondary btn-block">Cancel</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection