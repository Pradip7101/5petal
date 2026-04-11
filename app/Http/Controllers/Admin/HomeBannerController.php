<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HomeBanner;

class HomeBannerController extends Controller
{
    public function index()
    {
        $homeBanners = HomeBanner::all();
        return view('admin.home_banners.index', compact('homeBanners'));
    }

    public function create()
    {
        return view('admin.home_banners.create');
    }

    public function store(Request $request)
    {
        $validated = $this->validateData($request);
        if ($request->hasFile('banner_image')) {
            $validated['banner_image'] = $this->handleFileUpload($request->file('banner_image'));
        }

        HomeBanner::create($validated);

        return redirect()->route('admin.home-banners.index')->with('success', 'Banner created successfully.');
    }

    public function edit(HomeBanner $homeBanner)
    {
        return view('admin.home_banners.edit', compact('homeBanner'));
    }

    public function update(Request $request, HomeBanner $homeBanner)
    {
        $validated = $this->validateData($request, $homeBanner->id);
        if ($request->hasFile('banner_image')) {
            $this->deleteOldFile($homeBanner->banner_image);
            $validated['banner_image'] = $this->handleFileUpload($request->file('banner_image'));
        }

        $homeBanner->update($validated);

        return redirect()->route('admin.home-banners.index')->with('success', 'Banner updated successfully.');
    }

    public function destroy(HomeBanner $homeBanner)
    {
        $this->deleteOldFile($homeBanner->banner_image);
        $homeBanner->delete();

        return redirect()->route('admin.home-banners.index')->with('success', 'Banner deleted successfully.');
    }

    // Validate data
    private function validateData(Request $request, $dataId = null)
    {
        return $request->validate([
            'banner_title' => 'required|string|max:255',
            'banner_description' => 'nullable|string',
            'banner_image' => $dataId ? 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048' : 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'banner_button_text' => 'nullable|string',
            'banner_button_link' => 'nullable|string',
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
