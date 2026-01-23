<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('peserta_magang', function (Blueprint $table) {
            $table->integer('id')->autoIncrement();
            $table->enum('kategori_project', ['Aplikasi', 'Data Analitik', 'Infrastruktur', 'Keamanan'])->nullable();
            $table->text('tugas')->nullable();
            $table->string('nama_lengkap', 255)->nullable();
            $table->string('nomor_handphone', 20)->nullable();
            $table->string('email', 255)->nullable();
            $table->string('username_github', 100)->nullable();
            $table->enum('tingkat_pendidikan', ['SMK/SMA', 'Kuliah'])->nullable();
            $table->string('nama_sekolah', 255)->nullable();
            $table->string('jurusan', 255)->nullable();
            $table->integer('semester')->nullable();
            $table->enum('status', ['Belum Dimulai', 'Dalam Proses', 'Selesai', 'Permohonan'])->default('Permohonan');
            $table->enum('status_permohonan', ['Diterima', 'Ditolak'])->nullable();
            $table->date('tanggal_mulai')->nullable();
            $table->date('tanggal_selesai')->nullable();
            $table->text('catatan')->nullable();
            $table->boolean('is_active')->default(1);
            $table->string('user_input', 100)->nullable();
            $table->datetime('tanggal_input')->nullable();
            $table->string('user_update', 100)->nullable();
            $table->datetime('tanggal_update')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('peserta_magang');
    }
};
