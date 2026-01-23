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
        Schema::create('sekolah', function (Blueprint $table) {
            $table->integer('id')->autoIncrement();
            $table->string('npsn', 20)->nullable()->unique();
            $table->string('name', 255);
            $table->string('grade', 20)->nullable(); // SD, SMP, SMA, SMK
            $table->string('status', 10)->nullable(); // N = Negeri, S = Swasta
            $table->text('address')->nullable();
            $table->string('province_code', 10)->nullable();
            $table->string('province_name', 100)->nullable();
            $table->string('regency_code', 10)->nullable();
            $table->string('regency_name', 100)->nullable();
            $table->string('district_code', 10)->nullable();
            $table->string('district_name', 100)->nullable();
            $table->string('lang', 50)->nullable();
            $table->string('long', 50)->nullable();
            $table->boolean('is_active')->default(1);
            $table->datetime('last_synced_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sekolah');
    }
};
