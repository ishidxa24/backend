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
        Schema::create('skill_keywords', function (Blueprint $table) {
            $table->id();
            $table->string('keyword');
            $table->string('category')->nullable(); // Tech / Interest
            $table->unsignedBigInteger('learning_path_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('skill_keywords');
    }
};
