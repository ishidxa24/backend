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
        Schema::create('user_roadmaps', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('job_role'); // e.g., "Machine Learning", "Front-End Web"
            
            // Kolom JSON untuk menyimpan data roadmap (urutan kelas, modul, dll.)
            $table->json('roadmap_data'); 
            
            $table->boolean('is_active')->default(true); // Jika pengguna punya >1 roadmap
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_roadmaps');
    }
};