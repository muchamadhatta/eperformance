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
        Schema::table('universitas_custom', function (Blueprint $table) {
            // Drop old columns
            $table->dropColumn('type');
            
            // Add new columns matching universitas table
            $table->string('short_name', 100)->nullable()->after('name');
            $table->string('group', 20)->nullable()->after('short_name'); // PTS, PTN
            $table->string('university_type', 100)->nullable()->after('group'); // Akademi, Universitas, dll
            $table->text('address')->nullable()->after('university_type');
            $table->string('province', 100)->nullable()->after('address');
            $table->string('province_code', 10)->nullable()->after('province');
            $table->string('regency', 100)->nullable()->after('province_code');
            $table->string('regency_code', 10)->nullable()->after('regency');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('universitas_custom', function (Blueprint $table) {
            $table->dropColumn([
                'short_name',
                'group',
                'university_type',
                'address',
                'province',
                'province_code',
                'regency',
                'regency_code',
            ]);
            $table->enum('type', ['Universitas', 'Sekolah'])->default('Universitas')->after('name');
        });
    }
};
