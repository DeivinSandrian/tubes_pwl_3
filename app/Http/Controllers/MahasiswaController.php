<?php
namespace App\Http\Controllers;

use App\Models\Pengajuan;
use App\Models\Surat;
use App\Models\User;
use App\Notifications\SuratDiajukanNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;

class MahasiswaController extends Controller
{
    public function dashboard()
    {
        $user = Auth::user();
        $surats = Surat::where('user_id_user', $user->id_user)->with('programStudi')->get();
        return view('mahasiswa.dashboard', compact('surats'));
    }

    public function letters()
    {
        $user = Auth::user();
        $pengajuans = Pengajuan::where('user_id_user', $user->id_user)->with('programStudi')->get();
        return view('mahasiswa.letters', compact('surats'));
    }

    public function create($type)
    {
        $user = Auth::user();

        if ($user->role !== 'mahasiswa') {
            return redirect()->route('home')->with('error', 'Akses ditolak. Hanya mahasiswa yang dapat membuat surat.');
        }

        $letterTypes = [
            'SKMA' => 'Surat Keterangan Mahasiswa Aktif',
            'SKT' => 'Surat Keterangan Lulus',
            'SPTMK' => 'Surat Pengantar Tugas Mata Kuliah',
            'LHS' => 'Laporan Hasil Studi',
        ];

        if (!array_key_exists($type, $letterTypes)) {
            return redirect()->route('mahasiswa.dashboard')->with('error', 'Jenis surat tidak valid.');
        }

        return view('mahasiswa.letters.create-' . strtolower($type), [
            'type' => $type,
            'title' => $letterTypes[$type],
        ]);
    }

    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'surat_id_surat' => ['required', 'exists:surat,id_surat'],
    //         'keterangan' => ['required', 'string'],
    //     ]);

    //     $user = Auth::user();

    //     Pengajuan::create([
    //         'user_id_user' => $user->id_user,
    //         'surat_id_surat' => $request->surat_id_surat,
    //         'keterangan' => $request->keterangan,
    //         'status' => 'pending',
    //     ]);

    //     return redirect()->route('mahasiswa.letters')->with('success', 'Letter request submitted successfully.');
    // }

    public function store(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'jenis_surat' => 'required|in:SKMA,SKT,SPTMK,LHS',
            'nama_lengkap' => 'nullable|string|max:100',
            'nrp' => 'nullable|string|max:255',
            'semester' => 'nullable|integer',
            'alamat_lengkap_bandung' => 'nullable|string|max:255',
            'keperluan_pengajuan' => 'nullable|string|max:255',
            'surat_ditujukan_kepada' => 'nullable|string|max:255',
            'nama_mata_kuliah' => 'nullable|string|max:255',
            'kode_mata_kuliah' => 'nullable|string|max:255',
            'topik' => 'nullable|string|max:255',
            'data_mahasiswa' => 'nullable|string|max:255',
            'tanggal_kelulusan' => 'nullable|date',
        ]);

        $data = [
            'jenis_surat' => $request->jenis_surat,
            'status_pengajuan' => 'pending',
            'user_id_user' => $user->id_user,
            'program_studi_id_prodi' => $user->program_studi_id_prodi,
        ];

        if ($request->jenis_surat === 'SKMA') {
            $data['semester'] = $request->semester;
            $data['alamat_lengkap_bandung'] = $request->alamat_lengkap_bandung;
            $data['keperluan_pengajuan'] = $request->keperluan_pengajuan;
        } elseif ($request->jenis_surat === 'SKT') {
            $data['tanggal_kelulusan'] = $request->tanggal_kelulusan;
        } elseif ($request->jenis_surat === 'SPTMK') {
            $data['surat_ditujukan_kepada'] = $request->surat_ditujukan_kepada;
            $data['nama_mata_kuliah'] = $request->nama_mata_kuliah;
            $data['kode_mata_kuliah'] = $request->kode_mata_kuliah;
            $data['semester'] = $request->semester;
            $data['data_mahasiswa'] = $request->data_mahasiswa;
            $data['keperluan_pengajuan'] = $request->keperluan_pengajuan;
            $data['topik'] = $request->topik;
        } elseif ($request->jenis_surat === 'LHS') {
            $data['keperluan_pengajuan'] = $request->keperluan_pengajuan;
        }

        Surat::create($data);
        $surat = Surat::create($data);

        // kirim notifikasi ke kaprodi
        $kaprodis = User::where('role', 'ketua')
        ->where('program_studi_id_prodi', $user->program_studi_id_prodi)
        ->get();

        foreach ($kaprodis as $kaprodi) {
            $kaprodi->notify(new SuratDiajukanNotification($surat));
        }

        return redirect()->route('mahasiswa.dashboard')->with('success', 'Permohonan surat berhasil diajukan.');
    }

    // public function show($id)
    // {
    //     $pengajuan = Pengajuan::with('surat', 'user', 'detailSurat')->findOrFail($id);
    //     return view('mahasiswa.letters_show', compact('pengajuan'));
    // }

    public function show($id)
    {
    $surat = Surat::findOrFail($id);

    // Pastikan hanya user yang mengajukan yang bisa lihat
    if ($surat->user_id_user !== Auth::id()) {
        return redirect()->route('mahasiswa.dashboard')->with('error', 'Anda tidak memiliki akses ke surat ini.');
    }

    // Tentukan view berdasarkan jenis surat
    $viewMap = [
        'SKMA' => 'mahasiswa.letters.show-skma',
        'SKT' => 'mahasiswa.letters.show-skt',
        'SPTMK' => 'mahasiswa.letters.show-sptmk',
        'LHS' => 'mahasiswa.letters.show-lhs',
    ];

    $jenis = $surat->jenis_surat;

    if (!array_key_exists($jenis, $viewMap)) {
        return redirect()->route('mahasiswa.dashboard')->with('error', 'Jenis surat tidak dikenali.');
    }

    return view($viewMap[$jenis], [
        'surat' => $surat,
        'title' => 'Detail Surat ' . $jenis,
    ]);
    }

    public function download($id)
    {
    $surat = Surat::findOrFail($id);

    // Cek apakah file ada
    if (!$surat->file_path || !Storage::exists($surat->file_path)) {
        return redirect()->route('mahasiswa.letters.show', $id)->with('error', 'File surat tidak tersedia.');
    }

    // // Cek apakah user yang login adalah pemiliknya
    // if ($surat->user_id_user !== Auth::id()) {
    //     abort(403, 'Anda tidak memiliki akses ke file ini.');
    // }

    // Kirim response file
    return response()->download(storage_path('app/private/' . $surat->file_path));
    }


    public function edit($id)
    {
    $surat = Surat::findOrFail($id);

    if ($surat->user_id_user !== Auth::user()->id_user) {
        return redirect()->route('mahasiswa.dashboard')->with('error', 'Anda tidak memiliki akses ke surat ini.');
    }

    $viewMap = [
        'SKMA' => 'mahasiswa.letters.edit-skma',
        'SKT' => 'mahasiswa.letters.edit-skt',
        'SPTMK' => 'mahasiswa.letters.edit-sptmk',
        'LHS' => 'mahasiswa.letters.edit-lhs',
    ];

    if (!array_key_exists($surat->jenis_surat, $viewMap)) {
        return redirect()->route('mahasiswa.dashboard')->with('error', 'Jenis surat tidak dikenali.');
    }

    return view($viewMap[$surat->jenis_surat], compact('surat'));
    }


    public function update(Request $request, $id)
    {
    $surat = Surat::findOrFail($id);

    if ($surat->user_id_user !== Auth::user()->id_user) {
        return redirect()->route('mahasiswa.dashboard')->with('error', 'Anda tidak memiliki akses untuk mengubah surat ini.');
    }

    $validated = $request->validate([
        'semester' => 'nullable|integer',
        'alamat_lengkap_bandung' => 'nullable|string|max:255',
        'keperluan_pengajuan' => 'nullable|string|max:255',
        'surat_ditujukan_kepada' => 'nullable|string|max:255',
        'nama_mata_kuliah' => 'nullable|string|max:255',
        'kode_mata_kuliah' => 'nullable|string|max:255',
        'data_mahasiswa' => 'nullable|string|max:255',
        'topik' => 'nullable|string|max:255',
        'tanggal_kelulusan' => 'nullable|date',
    ]);

    // Update field sesuai jenis surat
    switch ($surat->jenis_surat) {
        case 'SKMA':
            $surat->semester = $request->semester;
            $surat->alamat_lengkap_bandung = $request->alamat_lengkap_bandung;
            $surat->keperluan_pengajuan = $request->keperluan_pengajuan;
            break;

        case 'SKT':
            $surat->tanggal_kelulusan = $request->tanggal_kelulusan;
            break;

        case 'SPTMK':
            $surat->surat_ditujukan_kepada = $request->surat_ditujukan_kepada;
            $surat->nama_mata_kuliah = $request->nama_mata_kuliah;
            $surat->kode_mata_kuliah = $request->kode_mata_kuliah;
            $surat->semester = $request->semester;
            $surat->data_mahasiswa = $request->data_mahasiswa;
            $surat->keperluan_pengajuan = $request->keperluan_pengajuan;
            $surat->topik = $request->topik;
            break;

        case 'LHS':
            $surat->keperluan_pengajuan = $request->keperluan_pengajuan;
            break;
    }

    $surat->save();

    return Redirect::route('mahasiswa.letters.show', $id)->with('success', 'Surat berhasil diperbarui.');
    }


    public function destroy($id)
    {
    $surat = Surat::findOrFail($id);

    // Pastikan hanya pemilik surat yang bisa menghapus
    if ($surat->user_id_user !== Auth::user()->id_user) {
        return redirect()->route('mahasiswa.dashboard')->with('error', 'Anda tidak memiliki akses untuk menghapus surat ini.');
    }

    // Hapus file jika ada
    if ($surat->file_path && \Storage::exists($surat->file_path)) {
        \Storage::delete($surat->file_path);
    }

    $surat->delete();

    return redirect()->route('mahasiswa.dashboard')->with('success', 'Surat berhasil dihapus.');
    }




}