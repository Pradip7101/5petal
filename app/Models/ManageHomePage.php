<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ManageHomePage extends Model
{
    use HasFactory;

    protected $fillable = [
        'below_banner_description',
        'sale_section_sale_text_left',
        'sale_section_sale_text_right',
        'sale_section_sale_start',
        'sale_section_sale_end',
        'home_video',
    ];

    protected $casts = [
        'sale_section_sale_start' => 'datetime',
        'sale_section_sale_end' => 'datetime',
    ];
}
