<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Reel;

class ReelsController extends Controller
{
    public function index()
    {
        $reels = Reel::where('is_active', true)
            ->orderBy('sort_order')
            ->orderByDesc('id')
            ->get()
            ->map(fn($reel) => [
                'id'               => $reel->id,
                'title'            => $reel->title,
                'youtube_id'       => $reel->youtube_id,
                'video_url'        => $reel->video_url,
                'thumbnail_url'    => $reel->thumbnail_url,
                'discount_percent' => $reel->discount_percent,
                'price'            => $reel->price,
                'original_price'   => $reel->original_price,
                'views_count'      => $reel->views_count,
                'products'         => [],   // extend later when reel-product relation is added
            ]);

        return response()->json([
            'status' => 'success',
            'data'   => $reels,
        ]);
    }
}
