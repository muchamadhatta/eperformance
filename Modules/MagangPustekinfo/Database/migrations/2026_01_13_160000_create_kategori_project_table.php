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
        Schema::create('kategori_project', function (Blueprint $table) {
            $table->integer('id')->autoIncrement();
            $table->string('name', 100);
            $table->string('description', 255)->nullable();
            $table->string('icon', 100)->nullable(); // Remixicon class
            $table->boolean('is_active')->default(true);
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });

        // Insert default categories
        DB::table('kategori_project')->insert([
            ['name' => 'Aplikasi', 'description' => 'Web & Mobile Dev', 'icon' => 'ri-code-s-slash-line', 'is_active' => true, 'sort_order' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Data Analitik', 'description' => 'Data Science', 'icon' => 'ri-pie-chart-2-line', 'is_active' => true, 'sort_order' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Infrastruktur', 'description' => 'Network & Server', 'icon' => 'ri-server-line', 'is_active' => true, 'sort_order' => 3, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Keamanan', 'description' => 'Cyber Security', 'icon' => 'ri-shield-check-line', 'is_active' => true, 'sort_order' => 4, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kategori_project');
    }
};
