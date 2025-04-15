<?php
namespace App\Http\Controllers;

use App\Models\Pengajuan;
use App\Models\Surat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MahasiswaController extends Controller
{
    public function dashboard()
    {
        $user = Auth::user();
        $pengajuans = Pengajuan::where('user_id_user', $user->id_user)->with('surat')->get();
        return view('mahasiswa.dashboard', compact('pengajuans'));
    }

    public function letters()
    {
        $user = Auth::user();
        $pengajuans = Pengajuan::where('user_id_user', $user->id_user)->with('surat')->get();
        return view('mahasiswa.letters', compact('pengajuans'));
    }

    public function create()
    {
        $surats = Surat::all();
        return view('mahasiswa.letters_create', compact('surats'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'surat_id_surat' => ['required', 'exists:surat,id_surat'],
            'keterangan' => ['required', 'string'],
        ]);

        $user = Auth::user();

        Pengajuan::create([
            'user_id_user' => $user->id_user,
            'surat_id_surat' => $request->surat_id_surat,
            'keterangan' => $request->keterangan,
            'status' => 'pending',
        ]);

        return redirect()->route('mahasiswa.letters')->with('success', 'Letter request submitted successfully.');
    }

    public function show($id)
    {
        $pengajuan = Pengajuan::with('surat', 'user', 'detailSurat')->findOrFail($id);
        return view('mahasiswa.letters_show', compact('pengajuan'));
    }
}