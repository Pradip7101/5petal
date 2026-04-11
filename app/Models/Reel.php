<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reel extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'video_file',
        'youtube_id',
        'thumbnail_image',
        'discount_percent',
        'price',
        'original_price',
        'views_count',
        'is_active',
        'sort_order',
    ];

    protected $casts = [
        'is_active'        => 'boolean',
        'price'            => 'float',
        'original_price'   => 'float',
        'discount_percent' => 'integer',
        'sort_order'       => 'integer',
    ];

    // ── Accessors for frontend-ready URLs ──────────────────────
    public function getThumbnailUrlAttribute(): ?string
    {
        if ($this->youtube_id) {
            return "https://img.youtube.com/vi/{$this->youtube_id}/maxresdefault.jpg";
        }
        if ($this->thumbnail_image) {
            return asset('admin_assets/uploads/' . $this->thumbnail_image);
        }
        return null;
    }

    public function getVideoUrlAttribute(): ?string
    {
        return $this->video_file
            ? asset('admin_assets/uploads/' . $this->video_file)
            : null;
    }
}
