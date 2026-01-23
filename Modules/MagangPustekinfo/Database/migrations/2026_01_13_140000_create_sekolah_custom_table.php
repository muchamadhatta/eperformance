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
        Schema::create('sekolah_custom', function (Blueprint $table) {
            $table->integer('id')->autoIncrement();
            $table->string('npsn', 20)->nullable();
            $table->string('name', 255);
            $table->string('grade', 20)->nullable(); // SD, SMP, SMA, SMK
            $table->string('status', 10)->nullable(); // N = Negeri, S = Swasta
            $table->text('address')->nullable();
            $table->string('province_name', 100)->nullable();
            $table->string('regency_name', 100)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sekolah_custom');
    }
};
