<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ThemeOption extends Model
{
    use HasFactory;

    protected $fillable = [
        'top_header1_text',
        'top_header2_text',
        'top_header2_text_price',
        'mega_menu_banner',
        'header_logo', 
        'footer_description', 
        'social_links',
        'admin_email',
        'admin_phone',
        'footer_payment_logo',
        'footer_image1',
        'footer_image2',
        'above_footer_section',
        'modal_title',
        'modal_subtitle',
        'modal_below_text',
        'modal_features',
    ];

    protected $casts = [
        'modal_features' => 'array',
        'above_footer_section' => 'array',
    ];
}
