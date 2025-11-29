<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('student_progress', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('email')->index(); // Index untuk pencarian cepat saat register
            $table->string('course_name')->nullable();
            $table->integer('active_tutorials')->default(0);
            $table->integer('completed_tutorials')->default(0);
            $table->boolean('is_graduated')->default(false);
            $table->integer('exam_score')->nullable();
            // Tambahkan kolom lain dari CSV jika perlu analisis mendalam
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_progress');
    }
};
