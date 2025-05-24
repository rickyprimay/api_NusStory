<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class GuessFigureQuiz extends Model
{
    protected $guarded = [];

    public function questions(): HasMany
    {
        return $this->hasMany(GuessFigureQuestion::class, 'quiz_id')->orderBy('order');
    }

    public function category()
    {
        return $this->belongsTo(Categories::class, 'category_id');
    }
} 