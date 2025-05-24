<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StoryProvince extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'subtitle',
        'latitude',
        'longitude',
        'slug'
    ];

    public function details()
    {
        return $this->hasMany(StoryProvinceDetail::class);
    }
}
