<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\ProgramStudi;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        $programStudis = ProgramStudi::all();
        return view('auth.register', compact('programStudis'));
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'nama' => ['required', 'string', 'max:100'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:100', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role' => ['required', 'in:mahasiswa,ketua,tatausaha'],
            'program_studi_id_prodi' => ['required', 'exists:program_studi,id_prodi'],
        ]);

        // Create the user manually
        $user = new User();
        $user->nama = $request->nama;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->role = $request->role;
        $user->program_studi_id_prodi = $request->program_studi_id_prodi;
        $user->save();

        event(new Registered($user));

        Auth::login($user);

        // Redirect based on role
        switch ($user->role) {
            case 'mahasiswa':
                return redirect()->route('mahasiswa.dashboard');
            case 'ketua':
                return redirect()->route('ketua.dashboard');
            case 'tatausaha':
                return redirect()->route('tatausaha.dashboard');
            default:
                return redirect('/');
        }
    }
}