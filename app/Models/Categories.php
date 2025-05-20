<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    protected $guarded = [];

    public function historicalTopics()
    {
        return $this->hasMany(HistoricalTopics::class);
    }

    public function historicalFigures()
    {
        return $this->hasMany(HistoricalFigures::class);
    }
}
