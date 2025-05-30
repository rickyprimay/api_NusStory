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
        Schema::create('story_province_details', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('image');
            $table->string('subtitle');
            $table->foreignId('story_province_id')->constrained('story_provinces')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('story_province_details');
    }
};
