<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use Illuminate\Http\Request;

class TestimonialsController extends Controller
{
    public function index()
    {
        $testimonials = Testimonial::all()->map(function($testimonial) {
            return [
                'id' => $testimonial->id,
                'name' => $testimonial->name,
                'description' => $testimonial->description,
                'image' => $testimonial->image ? asset('admin_assets/uploads/' . $testimonial->image) : null,
            ];
        });

        return response()->json([
            'success' => true,
            'data' => $testimonials
        ]);
    }
}
