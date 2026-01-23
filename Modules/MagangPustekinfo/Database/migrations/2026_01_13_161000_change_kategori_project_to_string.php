<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Change kategori_project from enum to string to support dynamic categories
        Schema::table('peserta_magang', function (Blueprint $table) {
            $table->string('kategori_project', 100)->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Revert back to enum (warning: data loss if values don't match enum)
        Schema::table('peserta_magang', function (Blueprint $table) {
            // Note: DBAL might struggle with converting string to enum directly in some drivers
            // This is a best effort reverse
            $table->enum('kategori_project', ['Aplikasi', 'Data Analitik', 'Infrastruktur', 'Keamanan'])->nullable()->change();
        });
    }
};
