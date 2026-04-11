<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ManageHomePage;

class ManageHomePageController extends Controller
{
    public function index()
    {
        $manageHomePage = ManageHomePage::firstOrCreate([]);
        return view('admin.manage_home_page', compact('manageHomePage'));
    }

    public function update(Request $request)
    {
        $validated = $this->validateData($request);
        $homePage = ManageHomePage::first();

        if ($request->hasFile('home_video')) {

            $path = public_path('admin_assets/uploads/home-videos');

            if (!file_exists($path)) {
                mkdir($path, 0755, true);
            }

            // delete old video
            if ($homePage->home_video && file_exists($path.'/'.$homePage->home_video)) {
                unlink($path.'/'.$homePage->home_video);
            }

            $videoName = time().'.'.$request->home_video->extension();
            $request->home_video->move($path, $videoName);

            $validated['home_video'] = $videoName;
        }

        $homePage->update($validated);

        return back()->with('success', 'Home page updated successfully');
    }

    private function validateData(Request $request)
    {
        return $request->validate([
            'below_banner_description' => 'nullable|string',
            'sale_section_sale_text_left' => 'nullable|string',
            'sale_section_sale_text_right' => 'nullable|string',
            'sale_section_sale_start' => 'nullable|date',
            'sale_section_sale_end' => 'nullable|date|after_or_equal:sale_section_sale_start',
            'home_video' => 'nullable|mimes:mp4,webm,ogg|max:51200',
        ]);
    }
}
