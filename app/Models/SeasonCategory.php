<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SeasonCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'image',
        'banner_image',
    ];
}
