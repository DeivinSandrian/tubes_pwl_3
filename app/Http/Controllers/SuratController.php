<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Surat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SuratController extends Controller
{
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

    public function store(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'jenis_surat' => 'required|in:SKMA,SKT,SPTMK,LHS',
            'nama_lengkap' => 'required|string|max:100',
            'nrp' => 'required|string|max:255',
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

        return redirect()->route('mahasiswa.dashboard')->with('success', 'Permohonan surat berhasil diajukan.');
    }
}