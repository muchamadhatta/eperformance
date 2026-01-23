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
        Schema::create('universitas', function (Blueprint $table) {
            $table->integer('id')->autoIncrement();
            $table->string('name', 255);
            $table->string('short_name', 100)->nullable();
            $table->string('group', 20)->nullable(); // PTS, PTN
            $table->string('university_type', 100)->nullable(); // Akademi, Universitas, dll
            $table->text('address')->nullable();
            $table->string('province', 100)->nullable();
            $table->string('province_code', 10)->nullable();
            $table->string('regency', 100)->nullable();
            $table->string('regency_code', 10)->nullable();
            $table->string('lat', 50)->nullable();
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
        Schema::dropIfExists('universitas');
    }
};
