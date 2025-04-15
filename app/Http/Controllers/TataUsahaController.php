<?php
namespace App\Http\Controllers;

use App\Models\Surat;
use App\Models\UploadSurat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class TataUsahaController extends Controller
{
    public function dashboard()
    {
        $surat = Surat::where('status_pengajuan', 'disetujui')
            ->whereHas('user', function ($query) {
                $query->where('program_studi_id_prodi', Auth::user()->program_studi_id_prodi);
            })->with('persetujuan', 'upload_surat')->get();

        return view('tata_usaha.dashboard', compact('surat'));
    }

    public function showCreateLetterForm($id)
    {
        $surat = Surat::where('id_surat', $id)
            ->where('status_pengajuan', 'disetujui')
            ->whereHas('user', function ($query) {
                $query->where('program_studi_id_prodi', Auth::user()->program_studi_id_prodi);
            })->with('persetujuan')->firstOrFail();

        $letterNumber = 'SURAT-' . $surat->id_surat . '-' . date('Ymd');
        $letterDate = now()->toDateString();

        return view('tata_usaha.create_letter', compact('surat', 'letterNumber', 'letterDate'));
    }

    public function storeLetter(Request $request)
    {
        $request->validate([
            'surat_id' => 'required|exists:surat,id_surat',
        ]);

        return redirect()->route('tata_usaha.upload_letter_form', $request->surat_id)
            ->with('success', 'Letter details saved. Please upload the letter.');
    }

    public function showUploadLetterForm($id)
    {
        $surat = Surat::where('id_surat', $id)
            ->where('status_pengajuan', 'disetujui')
            ->whereHas('user', function ($query) {
                $query->where('program_studi_id_prodi', Auth::user()->program_studi_id_prodi);
            })->firstOrFail();

        return view('tata_usaha.upload_letter', compact('surat'));
    }

    public function uploadLetter(Request $request)
    {
        $request->validate([
            'surat_id' => 'required|exists:surat,id_surat',
            'file_surat' => 'required|file|mimes:pdf|max:2048',
        ]);

        $surat = Surat::where('id_surat', $request->surat_id)
            ->where('status_pengajuan', 'disetujui')
            ->whereHas('user', function ($query) {
                $query->where('program_studi_id_prodi', Auth::user()->program_studi_id_prodi);
            })->firstOrFail();

        $filePath = $request->file('file_surat')->store('letters', 'public');

        UploadSurat::create([
            'file_surat' => $filePath,
            'tanggal_upload' => now()->toDateString(),
            'status_upload' => 'uploaded',
            'surat_id_surat' => $surat->id_surat,
            'surat_user_id_user' => $surat->user_id_user,
        ]);

        return redirect()->route('tata_usaha.dashboard')->with('success', 'Letter uploaded successfully.');
    }
}