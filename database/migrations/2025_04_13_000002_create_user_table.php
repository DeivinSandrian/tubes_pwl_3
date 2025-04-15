<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('user', function (Blueprint $table) {
            $table->id('id_user');
            $table->string('password', 255);
            $table->string('nama', 100);
            $table->string('email', 100)->unique();
            $table->enum('role', ['mahasiswa', 'ketua_program_studi', 'tata_usaha']);
            $table->foreignId('program_studi_id_prodi')->constrained('program_studi', 'id_prodi')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('user');
    }
};