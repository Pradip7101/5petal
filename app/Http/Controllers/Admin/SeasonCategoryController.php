<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SeasonCategory;
use Illuminate\Support\Str;

class SeasonCategoryController extends Controller
{
    public function index()
    {
        $seasonCategory = SeasonCategory::all();
        return view('admin.season_category.index', compact('seasonCategory'));
    }

    public function create()
    {
        return view('admin.season_category.create');
    }

    public function store(Request $request)
    {
        $validated = $this->validateData($request);

       // Generate and ensure a unique slug
       $validated['slug'] = $this->generateUniqueSlug($validated['title']);

        if ($request->hasFile('image')) {
            $validated['image'] = $this->handleFileUpload($request->file('image'));
        }
        if ($request->hasFile('banner_image')) {
            $validated['banner_image'] = $this->handleFileUpload($request->file('banner_image'));
        }

        SeasonCategory::create($validated);

        return redirect()->route('admin.season-category.index')->with('success', ' created successfully.');
    }

    public function edit(SeasonCategory $seasonCategory)
    {
        return view('admin.season_category.edit', compact('seasonCategory'));
    }

    public function update(Request $request, SeasonCategory $seasonCategory)
    {
        $validated = $this->validateData($request, $seasonCategory->id);

        // Generate a slug if the title has changed, ensuring it's unique
        $validated['slug'] = $this->generateUniqueSlug($validated['title'], $seasonCategory->id);

        if ($request->hasFile('image')) {
            $this->deleteOldFile($seasonCategory->image);
            $validated['image'] = $this->handleFileUpload($request->file('image'));
        } 

        if ($request->hasFile('banner_image')) {
            $this->deleteOldFile($seasonCategory->banner_image);
            $validated['banner_image'] = $this->handleFileUpload($request->file('banner_image'));
        }

        $seasonCategory->update($validated);

        return redirect()->route('admin.season-category.index')->with('success', 'Season Category updated successfully.');
    }

    public function destroy(SeasonCategory $seasonCategory)
    {
        $this->deleteOldFile($seasonCategory->image);
        $seasonCategory->delete();

        return redirect()->route('admin.season-category.index')->with('success', 'Season Category deleted successfully.');
    }

    // Generate a unique slug
    private function generateUniqueSlug($title, $seasonCategoryId = null)
    {
        $slug = Str::slug($title);
        $i = 1;
        while (SeasonCategory::where('slug', $slug)->where('id', '!=', $seasonCategoryId)->exists()) {
            $slug = $slug . '-' . $i++;
        }
        return $slug;
    }

    // Validate data
    private function validateData(Request $request, $dataId = null)
    {
        return $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string', 
            'image' => $dataId ? 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048' : 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'banner_image' => $dataId ? 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048' : 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
    }

    // Handle file upload
    private function handleFileUpload($file)
    {   
        $timestamp = time();
        $originalNameWithExtension = $file->getClientOriginalName();
        $extension = $file->getClientOriginalExtension();
        $originalName = pathinfo($originalNameWithExtension, PATHINFO_FILENAME);
        $imageName = $originalName . '_' . $timestamp . '.' . $extension;
        $file->move(public_path('admin_assets/uploads'), $imageName);
        return $imageName;
    }

    // Delete old file
    private function deleteOldFile($filename)
    {
        $filePath = public_path('admin_assets/uploads/' . $filename);
        if ($filename && file_exists($filePath)) {
            unlink($filePath);
        }
    }
}
