<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pengajuan', function (Blueprint $table) {
            $table->id('id_pengajuan');
            $table->unsignedBigInteger('user_id_user');
            $table->unsignedBigInteger('surat_id_surat');
            $table->text('keterangan');
            $table->enum('status', ['pending', 'approved', 'rejected', 'completed'])->default('pending');
            $table->timestamps();

            $table->foreign('user_id_user')->references('id_user')->on('user')->onDelete('cascade');
            $table->foreign('surat_id_surat')->references('id_surat')->on('surat')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pengajuan');
    }
};