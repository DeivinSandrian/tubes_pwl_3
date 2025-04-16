<?php

namespace Database\Seeders;

use App\Models\ProgramStudi;
use Illuminate\Database\Seeder;

class ProgramStudiSeeder extends Seeder
{
    public function run(): void
    {
        ProgramStudi::create([
            'nama_prodi' => 'Teknik Informatika',
        ]);

        ProgramStudi::create([
            'nama_prodi' => 'Sistem Informasi',
        ]);

        ProgramStudi::create([
            'nama_prodi' => 'Magister Ilmu Komputer',
        ]);
    }
}