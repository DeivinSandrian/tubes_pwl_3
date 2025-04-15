<?php

namespace App\Http\Controllers;

use App\Models\Surat;
use App\Models\UploadSurat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class TataUsahaController extends Controller
{
    /**
     * Display approved letters ready for processing
     */
    public function dashboard()
    {
        $letters = Surat::with(['user', 'persetujuan', 'uploadSurat'])
            ->where('status_pengajuan', 'approved')
            ->whereHas('user', function($query) {
                $query->where('program_studi_id_prodi', Auth::user()->program_studi_id_prodi);
            })
            ->latest()
            ->get();

        return view('tata_usaha.dashboard', compact('letters'));
    }

    /**
     * Show letter creation form
     */
    public function showCreateForm($id)
    {
        $letter = $this->getValidApprovedLetter($id);
        $letterNumber = $this->generateLetterNumber($letter);
        
        return view('tata_usaha.create_letter', [
            'letter' => $letter,
            'letterNumber' => $letterNumber,
            'letterDate' => now()->format('Y-m-d')
        ]);
    }

    /**
     * Process letter upload
     */
    public function uploadLetter(Request $request, $id)
    {
        $request->validate([
            'file_surat' => 'required|file|mimes:pdf|max:2048',
        ]);

        $letter = $this->getValidApprovedLetter($id);
        
        $filePath = $request->file('file_surat')->store('letters', 'public');

        UploadSurat::create([
            'file_surat' => $filePath,
            'tanggal_upload' => now(),
            'status_upload' => 'uploaded',
            'surat_id_surat' => $letter->id_surat,
            'surat_user_id_user' => $letter->user_id_user,
        ]);

        $letter->update(['status_pengajuan' => 'completed']);

        return redirect()
            ->route('tata_usaha.dashboard')
            ->with('success', 'Surat berhasil diunggah');
    }

    /**
     * Helper method to validate and fetch approved letter
     */
    protected function getValidApprovedLetter($id)
    {
        return Surat::where('id_surat', $id)
            ->where('status_pengajuan', 'approved')
            ->whereHas('user', function($query) {
                $query->where('program_studi_id_prodi', Auth::user()->program_studi_id_prodi);
            })
            ->firstOrFail();
    }

    /**
     * Generate formatted letter number
     */
    protected function generateLetterNumber(Surat $letter)
    {
        return sprintf('SURAT/%s/%s/%s', 
            $letter->id_surat, 
            $letter->user->programStudi->name_prod, 
            now()->format('Ymd')
        );
    }

    public function upload(Request $request, $id)
{
    $request->validate([
        'file' => 'required|file|mimes:pdf|max:2048', // PDF files, max 2MB
    ]);

    $pengajuan = Pengajuan::findOrFail($id);

    if ($pengajuan->status !== 'approved') {
        return redirect()->route('tatausaha.letters')->with('error', 'Cannot upload document for this request.');
    }

    $file = $request->file('file');
    $filePath = $file->store('letters', 'public'); // Store in storage/app/public/letters

    DetailSurat::create([
        'pengajuan_id_pengajuan' => $pengajuan->id_pengajuan,
        'file_path' => $filePath,
    ]);

    $pengajuan->update(['status' => 'completed']);

    return redirect()->route('tatausaha.letters')->with('success', 'Document uploaded successfully.');
}
}