<?php
namespace Database\Seeders;

use App\Models\ProgramStudi;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Seed Program Studi using DB::table to avoid timestamp issues
        // $programStudiData = [
        //     ['nama_prodi' => 'Teknik Informatika'],
        //     ['nama_prodi' => 'Sistem Informasi'],
        //     ['nama_prodi' => 'Magister Ilmu Komputer'],
        // ];

        // DB::table('program_studi')->insert($programStudiData);
        $this->call([
            ProgramStudiSeeder::class,
            SuratSeeder::class,
        ]);
        // Fetch the inserted program studies to get their IDs
        $ti = ProgramStudi::where('nama_prodi', 'Teknik Informatika')->first();
        $si = ProgramStudi::where('nama_prodi', 'Sistem Informasi')->first();
        $mik = ProgramStudi::where('nama_prodi', 'Magister Ilmu Komputer')->first();

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