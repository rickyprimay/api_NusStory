<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class GuessFigureQuestion extends Model
{
    protected $guarded = [];

    public function quiz(): BelongsTo
    {
        return $this->belongsTo(GuessFigureQuiz::class, 'quiz_id');
    }

    public function historicalFigure(): BelongsTo
    {
        return $this->belongsTo(HistoricalFigures::class, 'historical_figure_id');
    }
} 