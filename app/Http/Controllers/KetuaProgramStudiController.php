<?php

namespace App\Http\Controllers;

use App\Models\Surat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KetuaProgramStudiController extends Controller
{
    /**
     * Display pending letters for approval
     */
    public function dashboard()
    {
        $user = Auth::user();
        $surats = Surat::where('program_studi_id_prodi', $user->program_studi_id_prodi)
            // ->where('status_pengajuan', 'pending')
            ->with('user')
            ->get();

        return view('ketua_program_studi.dashboard', compact('surats'));
    }
    // $user = Auth::user();
    // $surats = Surat::where('user_id_user', $user->id_user)->with('programStudi')->get();
    // return view('ketua_program_studi.dashboard', compact('surats'));
    // }

    /**
     * Show approval form for a specific letter
     */
    public function showApprovalForm($id)
    {
        $letter = $this->getValidLetter($id);
        
        return view('ketua_program_studi.approve_letter', compact('letter'));
    }

    public function approve($id)
    {
        // Cari surat berdasarkan id_surat
        $surat = Surat::findOrFail($id);

        // Pastikan hanya ketua yang bisa melakukan aksi ini dan surat berstatus pending
        if (Auth::user()->role === 'ketua' && $surat->status_pengajuan === 'pending') {
            $surat->status_pengajuan = 'approved';
            $surat->save();

            return redirect()->route('ketua.dashboard')->with('success', 'Surat berhasil disetujui.');
        }

        return redirect()->route('ketua.dashboard')->with('error', 'Aksi tidak diizinkan.');
    }


    public function reject($id)
    {
        // Cari surat berdasarkan id_surat
        $surat = Surat::findOrFail($id);

        // Pastikan hanya ketua yang bisa melakukan aksi ini dan surat berstatus pending
        if (Auth::user()->role === 'ketua' && $surat->status_pengajuan === 'pending') {
            $surat->status_pengajuan = 'rejected';
            $surat->save();

            return redirect()->route('ketua.dashboard')->with('success', 'Surat berhasil ditolak.');
        }

        return redirect()->route('ketua.dashboard')->with('error', 'Aksi tidak diizinkan.');
    }

    /**
     * Helper method to validate and fetch letter
     */
    protected function getValidLetter($id)
    {
        return Surat::with(['user', 'detail'])
            ->where('id_surat', $id)
            ->where('status_pengajuan', 'pending')
            ->whereHas('user', function($query) {
                $query->where('program_studi_id_prodi', Auth::user()->program_studi_id_prodi);
            })
            ->firstOrFail();
    }

    public function show($id)
    {
    $surat = Surat::findOrFail($id);

    // // Pastikan hanya user yang mengajukan yang bisa lihat
    // if ($surat->user_id_user !== Auth::id()) {
    //     return redirect()->route('mahasiswa.dashboard')->with('error', 'Anda tidak memiliki akses ke surat ini.');
    // }

    // Tentukan view berdasarkan jenis surat
    $viewMap = [
        'SKMA' => 'mahasiswa.letters.show-skma',
        'SKT' => 'mahasiswa.letters.show-skt',
        'SPTMK' => 'mahasiswa.letters.show-sptmk',
        'LHS' => 'mahasiswa.letters.show-lhs',
    ];

    $jenis = $surat->jenis_surat;

    if (!array_key_exists($jenis, $viewMap)) {
        return redirect()->route('ketua.dashboard')->with('error', 'Jenis surat tidak dikenali.');
    }

    return view($viewMap[$jenis], [
        'surat' => $surat,
        'title' => 'Detail Surat ' . $jenis,
    ]);
    }
}