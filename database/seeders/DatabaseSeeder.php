<?php
namespace Database\Seeders;

use App\Models\ProgramStudi;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Seed Program Studi
        $ti = ProgramStudi::create(['nama_prodi' => 'Teknik Informatika']);
        $si = ProgramStudi::create(['nama_prodi' => 'Sistem Informasi']);
        $mik = ProgramStudi::create(['nama_prodi' => 'Magister Ilmu Komputer']);

        // Seed Users
        User::create([
            'nama' => 'Mahasiswa TI',
            'email' => 'mahasiswa.ti@example.com',
            'password' => Hash::make('password'),
            'role' => 'mahasiswa',
            'program_studi_id_prodi' => $ti->id_prodi,
        ]);

        User::create([
            'nama' => 'Ketua TI',
            'email' => 'ketua.ti@example.com',
            'password' => Hash::make('password'),
            'role' => 'ketua',
            'program_studi_id_prodi' => $ti->id_prodi,
        ]);

        User::create([
            'nama' => 'Tata Usaha TI',
            'email' => 'tatausaha.ti@example.com',
            'password' => Hash::make('password'),
            'role' => 'tatausaha',
            'program_studi_id_prodi' => $ti->id_prodi,
        ]);

        // Add users for other programs as needed
        User::create([
            'nama' => 'Mahasiswa SI',
            'email' => 'mahasiswa.si@example.com',
            'password' => Hash::make('password'),
            'role' => 'mahasiswa',
            'program_studi_id_prodi' => $si->id_prodi,
        ]);

        User::create([
            'nama' => 'Ketua SI',
            'email' => 'ketua.si@example.com',
            'password' => Hash::make('password'),
            'role' => 'ketua',
            'program_studi_id_prodi' => $si->id_prodi,
        ]);

        User::create([
            'nama' => 'Tata Usaha SI',
            'email' => 'tatausaha.si@example.com',
            'password' => Hash::make('password'),
            'role' => 'tatausaha',
            'program_studi_id_prodi' => $si->id_prodi,
        ]);
    }
}