<?php
namespace App\Http\Controllers;

use App\Models\Surat;
use App\Models\DetailSurat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class MahasiswaController extends Controller
{
    public function dashboard()
    {
        return view('mahasiswa.dashboard');
    }

    public function submitLetter()
    {
        return view('mahasiswa.submit_letter');
    }

    public function storeLetter(Request $request)
    {
        $request->validate([
            'jens_surat' => 'required|in:mahasiswa_aktif,pengantar_tugas,keterangan_lulus,laporan_studi',
            'alasan_pengajuan' => 'required|string',
        ]);

        $surat = Surat::create([
            'user_id_user' => Auth::id(),
            'jens_surat' => $request->jens_surat,
            'status_pengajuan' => 'pending',
            'tanggal_pengajuan' => now(),
        ]);

        DetailSurat::create([
            'surat_id_surat' => $surat->id_surat,
            'surat_user_id_user' => Auth::id(),
            'alasan_pengajuan' => $request->alasan_pengajuan,
        ]);

        return redirect()->route('mahasiswa.dashboard')->with('success', 'Letter submitted successfully.');
    }

    public function viewLetters()
    {
        $surats = Surat::where('user_id_user', Auth::id())->with('detail', 'upload')->get();
        return view('mahasiswa.letters', compact('surats'));
    }

    public function downloadLetter($id)
    {
        $surat = Surat::where('user_id_user', Auth::id())->findOrFail($id);
        $upload = $surat->upload;

        if (!$upload || !$upload->file_surat) {
            return redirect()->route('mahasiswa.letters')->with('error', 'File not available.');
        }

        return Storage::disk('public')->download($upload->file_surat);
    }
}