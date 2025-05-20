<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HistoricalTopics extends Model
{
    protected $guarded = [];

    public function province()
    {
        return $this->belongsTo(Province::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function category()
    {
        return $this->belongsTo(Categories::class);
    }
}
