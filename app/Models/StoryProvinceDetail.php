<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StoryProvinceDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'image',
        'subtitle',
        'story_province_id'
    ];

    public function province()
    {
        return $this->belongsTo(StoryProvince::class, 'story_province_id');
    }
}
