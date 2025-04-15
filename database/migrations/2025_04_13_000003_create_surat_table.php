<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('surat', function (Blueprint $table) {
            $table->id('id_surat');
            $table->enum('jenis_surat', [
                'surat keterangan mahasiswa aktif',
                'surat pengantar tugas mata kuliah',
                'surat keterangan lulus',
                'laporan hasil studi'
            ]);
            $table->enum('status_pengajuan', ['diajukan', 'disetujui', 'ditolak']);
            $table->date('tanggal_pengajuan');
            $table->date('tanggal_persetujuan')->nullable();
            $table->foreignId('user_id_user')->constrained('user', 'id_user')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('surat');
    }
};