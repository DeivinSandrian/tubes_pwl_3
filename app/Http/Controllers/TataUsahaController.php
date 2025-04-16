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
    // public function dashboard()
    // {
    //     $letters = Surat::with(['user', 'persetujuan', 'uploadSurat'])
    //         ->where('status_pengajuan', 'approved')
    //         ->whereHas('user', function($query) {
    //             $query->where('program_studi_id_prodi', Auth::user()->program_studi_id_prodi);
    //         })
    //         ->latest()
    //         ->get();

    //     return view('tata_usaha.dashboard', compact('letters'));
    // }

    public function dashboard()
    {
        $user = Auth::user();
        $surats = Surat::where('program_studi_id_prodi', $user->program_studi_id_prodi)
            ->whereIn('status_pengajuan', ['approved', 'completed'])
            ->with('user')
            ->get();

        return view('tata_usaha.dashboard', compact('surats'));
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
            'file_path' => 'required|file|mimes:pdf|max:2048',
        ]);

        $letter = $this->getValidApprovedLetter($id);
        
        $filePath = $request->file('file_path')->store('letters', 'public');

        UploadSurat::create([
            'file_path' => $filePath,
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

    // public function upload(Request $request, $id)
    // {
    // $request->validate([
    //     'file' => 'required|file|mimes:pdf|max:2048', // PDF files, max 2MB
    // ]);

    // $pengajuan = Pengajuan::findOrFail($id);

    // if ($pengajuan->status !== 'approved') {
    //     return redirect()->route('tatausaha.letters')->with('error', 'Cannot upload document for this request.');
    // }

    // $file = $request->file('file');
    // $filePath = $file->store('letters', 'public'); // Store in storage/app/public/letters

    // DetailSurat::create([
    //     'pengajuan_id_pengajuan' => $pengajuan->id_pengajuan,
    //     'file_path' => $filePath,
    // ]);

    // $pengajuan->update(['status' => 'completed']);

    // return redirect()->route('tatausaha.letters')->with('success', 'Document uploaded successfully.');
    // }

    public function upload(Request $request, $id)
    {
        $surat = Surat::findOrFail($id);

        $request->validate([
            'file_path' => 'required|file|mimes:pdf|max:2048', // max 2MB
        ]);

        // // Hapus file lama jika ada
        // if ($surat->file_path && Storage::exists($surat->file_path)) {
        //     Storage::delete($surat->file_path);
        // }

        // Hapus file lama jika ada
        if ($surat->file_path && Storage::disk('local')->exists('app/private/' . $surat->file_path)) {
        Storage::disk('local')->delete('app/private/' . $surat->file_path);
        }

        $path = $request->file('file_path')->store('surat');

        $surat->update([
            'file_path' => $path,
            'status_pengajuan' => 'completed', // update status jika perlu
        ]);

        return redirect()->back()->with('success', 'File surat berhasil diunggah.');
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
        return redirect()->route('tatausaha.dashboard')->with('error', 'Jenis surat tidak dikenali.');
    }

    return view($viewMap[$jenis], [
        'surat' => $surat,
        'title' => 'Detail Surat ' . $jenis,
    ]);
    }
}