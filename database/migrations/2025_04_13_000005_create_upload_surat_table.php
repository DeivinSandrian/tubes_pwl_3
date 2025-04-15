<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('upload_surat', function (Blueprint $table) {
            $table->id('id_upload');
            $table->string('file_surat', 255);
            $table->date('tanggal_upload');
            $table->enum('status_upload', ['uploaded', 'pending']);
            $table->foreignId('surat_id_surat')->constrained('surat', 'id_surat')->onDelete('cascade');
            $table->foreignId('surat_user_id_user')->constrained('user', 'id_user')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('upload_surat');
    }
};