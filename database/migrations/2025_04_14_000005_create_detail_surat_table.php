<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('detail_surat', function (Blueprint $table) {
            $table->id('id_detail_surat');
            $table->unsignedBigInteger('pengajuan_id_pengajuan');
            $table->string('file_path');
            $table->timestamps();

            $table->foreign('pengajuan_id_pengajuan')->references('id_pengajuan')->on('pengajuan')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('detail_surat');
    }
};