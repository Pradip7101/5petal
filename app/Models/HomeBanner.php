<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HomeBanner extends Model
{
    use HasFactory;

    protected $fillable = [
        'banner_title',
        'banner_description',
        'banner_image',
        'banner_button_text',
        'banner_button_link',
    ];
}
