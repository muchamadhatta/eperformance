<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Change ENUM values for tingkat_pendidikan
        DB::statement("ALTER TABLE peserta_magang MODIFY tingkat_pendidikan ENUM('SMK/SMA', 'Kuliah', 'PKL', 'Magang') NULL");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("ALTER TABLE peserta_magang MODIFY tingkat_pendidikan ENUM('SMK/SMA', 'Kuliah') NULL");
    }
};
