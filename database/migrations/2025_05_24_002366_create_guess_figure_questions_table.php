<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('guess_figure_questions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('quiz_id')->constrained('guess_figure_quizzes')->onDelete('cascade');
            $table->foreignId('historical_figure_id')->constrained('historical_figures')->onDelete('cascade');
            $table->string('image');
            $table->text('hint')->nullable();
            $table->decimal('correct_latitude', 10, 8);
            $table->decimal('correct_longitude', 11, 8);
            $table->integer('order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('guess_figure_questions');
    }
}; 