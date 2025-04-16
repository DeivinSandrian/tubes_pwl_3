<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Drop the existing ENUM and recreate it with the new value
        Schema::table('users', function (Blueprint $table) {
            $table->enum('role', ['mahasiswa', 'ketua', 'tatausaha', 'admin'])
                  ->default('mahasiswa')
                  ->change();
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->enum('role', ['mahasiswa', 'ketua', 'tatausaha'])
                  ->default('mahasiswa')
                  ->change();
        });
    }
};