<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProgramStudi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::whereIn('role', ['mahasiswa', 'ketua', 'tatausaha'])->get();
        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        $programStudis = ProgramStudi::all();
        return view('admin.users.create', compact('programStudis'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:100',
            'email' => 'required|string|email|max:100|unique:users',
            'password' => 'required|string|min:8',
            'role' => 'required|in:mahasiswa,ketua,tatausaha',
            'program_studi_id_prodi' => 'required|exists:program_studi,id_prodi',
        ]);

        User::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'program_studi_id_prodi' => $request->program_studi_id_prodi,
        ]);

        return redirect()->route('admin.users.index')->with('success', 'User created successfully.');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        $programStudis = ProgramStudi::all();
        return view('admin.users.edit', compact('user', 'programStudis'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:100',
            'email' => 'required|string|email|max:100|unique:users,email,' . $id . ',id_user',
            'role' => 'required|in:mahasiswa,ketua,tatausaha',
            'program_studi_id_prodi' => 'required|exists:program_studi,id_prodi',
        ]);

        $user = User::findOrFail($id);
        $data = [
            'nama' => $request->nama,
            'email' => $request->email,
            'role' => $request->role,
            'program_studi_id_prodi' => $request->program_studi_id_prodi,
        ];

        if ($request->filled('password')) {
            $request->validate([
                'password' => 'string|min:8',
            ]);
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return redirect()->route('admin.users.index')->with('success', 'User updated successfully.');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('admin.users.index')->with('success', 'User deleted successfully.');
    }
}