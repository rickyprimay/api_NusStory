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
        Schema::create('historical_figures', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('description');
            $table->text('content');
            $table->integer('born_year');
            $table->integer('died_year');
            $table->string('thumbnail');
            $table->string('video_url');
            $table->foreignId('category_id')->constrained('categories')->onDelete('cascade');
            $table->foreignId('province_id')->constrained('provinces')->onDelete('cascade');
            $table->foreignId('city_id')->constrained('cities')->onDelete('cascade');
            $table->string('slug');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('historical_figures');
    }
};
