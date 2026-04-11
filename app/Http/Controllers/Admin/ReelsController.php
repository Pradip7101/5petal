<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Reel;
use Illuminate\Http\Request;

class ReelsController extends Controller
{
    public function index()
    {
        $reels = Reel::orderBy('sort_order')->orderByDesc('id')->get();
        return view('admin.reels.index', compact('reels'));
    }

    public function create()
    {
        return view('admin.reels.create');
    }

    public function store(Request $request)
    {
        $validated = $this->validateData($request);

        if ($request->hasFile('video_file')) {
            $validated['video_file'] = $this->uploadFile($request->file('video_file'));
        }
        if ($request->hasFile('thumbnail_image')) {
            $validated['thumbnail_image'] = $this->uploadFile($request->file('thumbnail_image'));
        }

        $validated['is_active'] = $request->boolean('is_active');

        Reel::create($validated);

        return redirect()->route('admin.reels.index')->with('success', 'Reel created successfully.');
    }

    public function edit(Reel $reel)
    {
        return view('admin.reels.edit', compact('reel'));
    }

    public function update(Request $request, Reel $reel)
    {
        $validated = $this->validateData($request, $reel->id);

        if ($request->hasFile('video_file')) {
            $this->deleteFile($reel->video_file);
            $validated['video_file'] = $this->uploadFile($request->file('video_file'));
        }
        if ($request->hasFile('thumbnail_image')) {
            $this->deleteFile($reel->thumbnail_image);
            $validated['thumbnail_image'] = $this->uploadFile($request->file('thumbnail_image'));
        }

        $validated['is_active'] = $request->boolean('is_active');

        $reel->update($validated);

        return redirect()->route('admin.reels.index')->with('success', 'Reel updated successfully.');
    }

    public function destroy(Reel $reel)
    {
        $this->deleteFile($reel->video_file);
        $this->deleteFile($reel->thumbnail_image);
        $reel->delete();

        return redirect()->route('admin.reels.index')->with('success', 'Reel deleted successfully.');
    }

    // ── Helpers ────────────────────────────────────────────────

    private function validateData(Request $request, $id = null): array
    {
        return $request->validate([
            'title'            => 'required|string|max:255',
            'youtube_id'       => 'nullable|string|max:50',
            'video_file'       => $id ? 'nullable|file|mimes:mp4,webm,ogg|max:102400' : 'nullable|file|mimes:mp4,webm,ogg|max:102400',
            'thumbnail_image'  => $id ? 'nullable|image|mimes:jpeg,png,jpg,webp|max:4096' : 'nullable|image|mimes:jpeg,png,jpg,webp|max:4096',
            'discount_percent' => 'required|integer|min:0|max:100',
            'price'            => 'required|numeric|min:0',
            'original_price'   => 'required|numeric|min:0',
            'views_count'      => 'nullable|string|max:20',
            'sort_order'       => 'nullable|integer|min:0',
        ]);
    }

    private function uploadFile($file): string
    {
        $name = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)
            . '_' . time() . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('admin_assets/uploads'), $name);
        return $name;
    }

    private function deleteFile(?string $filename): void
    {
        if ($filename) {
            $path = public_path('admin_assets/uploads/' . $filename);
            if (file_exists($path)) unlink($path);
        }
    }
}
