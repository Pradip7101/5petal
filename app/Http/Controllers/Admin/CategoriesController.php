<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoriesController extends Controller
{
    // ================= LIST =================
    public function index()
    {
        $categories = Category::with('children')->get();
        return view('admin.categories.index', compact('categories'));
    }

    // ================= CREATE =================
    public function create()
    {
        $categories = Category::whereNull('parent_id')->get();
        return view('admin.categories.create', compact('categories'));
    }

    // ================= STORE =================
    public function store(Request $request)
    {
        $validated = $this->validateData($request);
        $validated['slug'] = Str::slug($validated['name']);

        // Image upload
        if ($request->hasFile('image')) {
            $validated['image'] = $this->uploadImage($request->file('image'));
        }

        // Mobile Banner image upload 👇
        if ($request->hasFile('cat_banner_mobile_image')) {
            $validated['cat_banner_mobile_image'] = $this->uploadImage($request->file('cat_banner_mobile_image'));
        }

        // Banner image upload
        if ($request->hasFile('cat_banner_image')) {
            $validated['cat_banner_image'] = $this->uploadImage($request->file('cat_banner_image'));
        }

        // Category video upload
        if ($request->hasFile('category_video')) {
            $validated['category_video'] = $this->uploadVideo($request->file('category_video'));
        }

        Category::create($validated);

        return redirect()
            ->route('admin.categories.index')
            ->with('success', 'Category created successfully.');
    }

    // ================= EDIT =================
    public function edit(Category $category)
    {
        $categories = Category::whereNull('parent_id')
            ->where('id', '!=', $category->id)
            ->get();

        return view('admin.categories.edit', compact('category', 'categories'));
    }

    // ================= UPDATE =================
    public function update(Request $request, Category $category)
    {
        $validated = $this->validateData($request, $category->id);
        $validated['slug'] = Str::slug($validated['name']);

        // Image update
        if ($request->hasFile('image')) {
            $this->deleteImage($category->image);
            $validated['image'] = $this->uploadImage($request->file('image'));
        }

        // Banner update
        if ($request->hasFile('cat_banner_image')) {
            $this->deleteImage($category->cat_banner_image);
            $validated['cat_banner_image'] = $this->uploadImage($request->file('cat_banner_image'));
        }

        // Mobile Banner update 👇
        if ($request->hasFile('cat_banner_mobile_image')) {
            $this->deleteImage($category->cat_banner_mobile_image);
            $validated['cat_banner_mobile_image'] = $this->uploadImage($request->file('cat_banner_mobile_image'));
        }

        // Video update
        if ($request->hasFile('category_video')) {
            $this->deleteVideo($category->category_video);
            $validated['category_video'] = $this->uploadVideo($request->file('category_video'));
        }

        $category->update($validated);

        return redirect()
            ->route('admin.categories.index')
            ->with('success', 'Category updated successfully.');
    }

    // ================= DELETE =================
    public function destroy(Category $category)
    {
        $this->deleteImage($category->image);
        $this->deleteImage($category->cat_banner_image);
        $this->deleteImage($category->cat_banner_mobile_image);
        $this->deleteVideo($category->category_video);

        $category->delete();

        return redirect()
            ->route('admin.categories.index')
            ->with('success', 'Category deleted successfully.');
    }

    // ================= VALIDATION =================
    private function validateData(Request $request, $id = null)
    {
        return $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',

            'image' => $id
                ? 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048'
                : 'required|image|mimes:jpg,jpeg,png,webp|max:2048',

            'cat_banner_image' => $id
                ? 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048'
                : 'required|image|mimes:jpg,jpeg,png,webp|max:2048',

            'cat_banner_mobile_image' => $id
                ? 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048'
                : 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',

            'category_video' => 'nullable|mimes:mp4,webm,ogg|max:51200',

            'parent_id' => 'nullable|exists:categories,id',
        ]);
    }

    // ================= IMAGE UPLOAD =================
    private function uploadImage($file)
    {
        $filename = uniqid() . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('admin_assets/uploads'), $filename);
        return $filename;
    }

    // ================= VIDEO UPLOAD =================
    private function uploadVideo($file)
    {
        $filename = uniqid() . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('admin_assets/uploads/category-videos'), $filename);
        return $filename;
    }

    // ================= DELETE IMAGE =================
    private function deleteImage($filename)
    {
        if (!$filename) return;

        $path = public_path('admin_assets/uploads/' . $filename);
        if (file_exists($path)) {
            unlink($path);
        }
    }

    // ================= DELETE VIDEO =================
    private function deleteVideo($filename)
    {
        if (!$filename) return;

        $path = public_path('admin_assets/uploads/category-videos/' . $filename);
        if (file_exists($path)) {
            unlink($path);
        }
    }
}
