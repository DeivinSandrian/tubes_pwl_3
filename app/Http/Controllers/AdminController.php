<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('admin.dashboard');
    }

    public function register()
    {
        // Check if an admin already exists
        if (User::where('role', 'admin')->exists()) {
            return redirect()->route('admin.dashboard')->with('error', 'An admin already exists.');
        }

        return view('admin.register');
    }

    public function store(Request $request)
    {
        // Check if an admin already exists
        if (User::where('role', 'admin')->exists()) {
            return redirect()->route('admin.dashboard')->with('error', 'An admin already exists.');
        }

        $request->validate([
            'nama' => 'required|string|max:100',
            'email' => 'required|string|email|max:100|unique:user',
            'password' => 'required|string|min:8|confirmed',
            // 'program_studi_id_prodi' => 'required|exists:program_studi,id_prodi',
        ]);

        User::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'admin',
            // 'program_studi_id_prodi' => $request->program_studi_id_prodi, // Admin does not belong to any program study
        ]);

        return redirect()->route('login')->with('success', 'Admin registered successfully. Please log in.');
    }

    public function manageRoles()
    {
        $kaprodi = User::where('role', 'ketua')->get();
        $tatausaha = User::where('role', 'tatausaha')->get();
        $user = User::whereIn('role', ['mahasiswa', 'ketua', 'tatausaha'])->get();

        return view('admin.roles', compact('kaprodi', 'tatausaha', 'user'));
    }

    public function updateKaprodi(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:user,id_user',
        ]);

        // Demote existing kaprodi to mahasiswa
        User::where('role', 'ketua')->update(['role' => 'mahasiswa']);

        // Promote selected user to kaprodi
        User::where('id_user', $request->user_id)->update(['role' => 'ketua']);

        return redirect()->route('admin.roles')->with('success', 'Kaprodi updated successfully.');
    }

    public function updateTataUsaha(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:user,id_user',
        ]);

        // Promote selected user to tatausaha (allow multiple tatausaha)
        User::where('id_user', $request->user_id)->update(['role' => 'tatausaha']);

        return redirect()->route('admin.roles')->with('success', 'Tata Usaha updated successfully.');
    }
}