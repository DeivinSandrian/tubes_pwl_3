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
        $letters = Surat::with(['user', 'detail'])
            ->where('status_pengajuan', 'pending')
            ->whereHas('user', function($query) {
                $query->where('program_studi_id_prodi', Auth::user()->program_studi_id_prodi);
            })
            ->latest()
            ->get();

        return view('ketua_program_studi.dashboard', compact('letters'));
    }

    /**
     * Show approval form for a specific letter
     */
    public function showApprovalForm($id)
    {
        $letter = $this->getValidLetter($id);
        
        return view('ketua_program_studi.approve_letter', compact('letter'));
    }

    /**
     * Process letter approval
     */
    public function approveLetter(Request $request, $id)
    {
        $letter = $this->getValidLetter($id);
        
        $letter->update([
            'status_pengajuan' => 'approved',
            'tanggal_persetujuan' => now(),
        ]);

        return redirect()
            ->route('ketua.dashboard')
            ->with('success', 'Surat berhasil disetujui');
    }

    /**
     * Process letter rejection
     */
    public function rejectLetter(Request $request, $id)
    {
        $letter = $this->getValidLetter($id);
        
        $letter->update([
            'status_pengajuan' => 'rejected',
            'tanggal_persetujuan' => now(),
        ]);

        return redirect()
            ->route('ketua.dashboard')
            ->with('success', 'Surat berhasil ditolak');
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
}