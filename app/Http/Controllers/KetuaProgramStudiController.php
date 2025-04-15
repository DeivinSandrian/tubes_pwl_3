<?php

namespace App\Http\Controllers;

use App\Models\Surat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KetuaProgramStudiController extends Controller
{
    /**
     * Display the dashboard with pending letter requests for the Ketua's program.
     *
     * @return \Illuminate\View\View
     */
    public function dashboard()
    {
        // Fetch pending letters for the Ketua's program study
        $letters = Surat::where('status_pengajuan', 'pending')
            ->whereHas('user', function ($query) {
                $query->where('program_studi_id_prodi', Auth::user()->program_studi_id_prodi);
            })
            ->with('detail', 'user')
            ->get();

        return view('ketua_program_studi.dashboard', compact('letters'));
    }

    /**
     * Show the form to approve or reject a letter request.
     *
     * @param int $id The ID of the letter (id_surat)
     * @return \Illuminate\View\View
     */
    public function approveLetter($id)
    {
        // Fetch the letter, ensuring it belongs to the Ketua's program study
        $letter = Surat::where('id_surat', $id)
            ->whereHas('user', function ($query) {
                $query->where('program_studi_id_prodi', Auth::user()->program_studi_id_prodi);
            })
            ->with('detail', 'user')
            ->firstOrFail();

        // Ensure the letter is still pending
        if ($letter->status_pengajuan !== 'pending') {
            return redirect()->route('ketua.dashboard')->with('error', 'This letter has already been processed.');
        }

        return view('ketua_program_studi.approve_letter', compact('letter'));
    }

    /**
     * Handle the approval of a letter request.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id The ID of the letter (id_surat)
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storeApproval(Request $request, $id)
    {
        // Fetch the letter, ensuring it belongs to the Ketua's program study
        $letter = Surat::where('id_surat', $id)
            ->whereHas('user', function ($query) {
                $query->where('program_studi_id_prodi', Auth::user()->program_studi_id_prodi);
            })
            ->firstOrFail();

        // Ensure the letter is still pending
        if ($letter->status_pengajuan !== 'pending') {
            return redirect()->route('ketua.dashboard')->with('error', 'This letter has already been processed.');
        }

        // Update the letter status to approved
        $letter->update([
            'status_pengajuan' => 'approved',
            'tanggal_persetujuan' => now(),
        ]);

        return redirect()->route('ketua.dashboard')->with('success', 'Letter approved successfully.');
    }

    /**
     * Handle the rejection of a letter request.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id The ID of the letter (id_surat)
     * @return \Illuminate\Http\RedirectResponse
     */
    public function rejectLetter(Request $request, $id)
    {
        // Fetch the letter, ensuring it belongs to the Ketua's program study
        $letter = Surat::where('id_surat', $id)
            ->whereHas('user', function ($query) {
                $query->where('program_studi_id_prodi', Auth::user()->program_studi_id_prodi);
            })
            ->firstOrFail();

        // Ensure the letter is still pending
        if ($letter->status_pengajuan !== 'pending') {
            return redirect()->route('ketua.dashboard')->with('error', 'This letter has already been processed.');
        }

        // Update the letter status to rejected
        $letter->update([
            'status_pengajuan' => 'rejected',
            'tanggal_persetujuan' => now(),
        ]);

        return redirect()->route('ketua.dashboard')->with('success', 'Letter rejected successfully.');
    }
}