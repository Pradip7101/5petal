<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ThemeOption;
use Illuminate\Support\Facades\Storage;

class ThemeOptionController extends Controller
{
    public function index()
    {
        // Fetch or create the ThemeOption instance
        $themeOptions = ThemeOption::firstOrCreate([]);
        return view('admin.theme_options', compact('themeOptions'));
    }

    public function update(Request $request, ThemeOption $themeOption)
    {  
        $validated = $this->validateData($request, $themeOption->id);
        $themeOptions = ThemeOption::first();

        // Helper: strip full URL to get just filename for file operations
        $stripUrl = function($value) {
            if (empty($value)) return null;
            if (str_starts_with($value, 'http')) {
                return basename(parse_url($value, PHP_URL_PATH));
            }
            return $value;
        };

        if ($request->hasFile('mega_menu_banner')) {
            if ($themeOptions->mega_menu_banner) {
                $old = $stripUrl($themeOptions->mega_menu_banner);
                $path = public_path('admin_assets/uploads/') . $old;
                if ($old && file_exists($path)) @unlink($path);
            }
            $validated['mega_menu_banner'] = $this->handleFileUpload($request->file('mega_menu_banner'));
        }

        if ($request->hasFile('header_logo')) {
            if ($themeOptions->header_logo) {
                $old = $stripUrl($themeOptions->header_logo);
                $path = public_path('admin_assets/uploads/') . $old;
                if ($old && file_exists($path)) @unlink($path);
            }
            $validated['header_logo'] = $this->handleFileUpload($request->file('header_logo'));
        }

        if ($request->hasFile('footer_payment_logo')) {
            if ($themeOptions->footer_payment_logo) {
                $old = $stripUrl($themeOptions->footer_payment_logo);
                $path = public_path('admin_assets/uploads/') . $old;
                if ($old && file_exists($path)) @unlink($path);
            }
            $validated['footer_payment_logo'] = $this->handleFileUpload($request->file('footer_payment_logo'));
        }

        if ($request->hasFile('footer_image1')) {
            if ($themeOptions->footer_image1) {
                $old = $stripUrl($themeOptions->footer_image1);
                $path = public_path('admin_assets/uploads/') . $old;
                if ($old && file_exists($path)) @unlink($path);
            }
            $validated['footer_image1'] = $this->handleFileUpload($request->file('footer_image1'));
        }

        if ($request->hasFile('footer_image2')) {
            if ($themeOptions->footer_image2) {
                $old = $stripUrl($themeOptions->footer_image2);
                $path = public_path('admin_assets/uploads/') . $old;
                if ($old && file_exists($path)) @unlink($path);
            }
            $validated['footer_image2'] = $this->handleFileUpload($request->file('footer_image2'));
        }

        /* ================= TOP HEADER 1 REPEATER ================= */

        $existingTopHeader1 = json_decode($themeOptions->top_header1_texts, true) ?? [];
        $updatedTopHeader1 = [];

        if ($request->has('top_header1_texts')) {
            foreach ($validated['top_header1_texts'] as $index => $item) {
                $updatedTopHeader1[$index] = [
                    'text' => $item['text'] ?? null,
                ];
            }
            $validated['top_header1_texts'] = array_values($updatedTopHeader1);
        } else {
            $validated['top_header1_texts'] = [];
        }
        // Fetch existing social links
        $existingSocialLinks = json_decode($themeOptions->social_links, true) ?? [];
        // Strip any full URLs from existing social links to get just filenames
        foreach ($existingSocialLinks as &$existing) {
            if (!empty($existing['social_icon'])) {
                $existing['social_icon'] = $stripUrl($existing['social_icon']);
            }
        }
        unset($existing);
        $updatedSocialLinks = [];
        $deletedImages = [];

        // Check if there are social links in the request
        if ($request->has('social_links')) {  
            $submittedSocialLinks = $validated['social_links'];
            // Create a map to track which indices are present in submitted data
            $submittedIndices = array_keys($submittedSocialLinks);
            $existingIndices = array_keys($existingSocialLinks);

            // Track the rows that need to be updated or added
            foreach ($submittedSocialLinks as $index => $socialLink) {
                if (array_key_exists($index, $existingSocialLinks)) {
                    // Existing link; update it
                    $socialIcon = $existingSocialLinks[$index]['social_icon'];

                    // Check if the submitted icon is different from the existing one
                    if (isset($socialLink['social_icon']) && $socialLink['social_icon'] !== $existingSocialLinks[$index]['social_icon']) {
                        // Mark the old icon for deletion
                        if (isset($existingSocialLinks[$index]['social_icon']) && file_exists(public_path('admin_assets/uploads/') . $existingSocialLinks[$index]['social_icon'])) {
                            $deletedImages[] = $existingSocialLinks[$index]['social_icon'];
                        }
                        // Upload new icon
                        $socialIcon = $this->handleFileUpload($socialLink['social_icon']);
                    }

                    // Update the existing social link
                    $updatedSocialLinks[$index] = [
                        'social_link_url' => $socialLink['social_link_url'] ?? null,
                        'social_icon' => $socialIcon,
                    ];
                } else {
                    // New link; add it to the updated list
                    $updatedSocialLinks[$index] = [
                        'social_link_url' => $socialLink['social_link_url'] ?? null,
                        'social_icon' => isset($socialLink['social_icon']) ? $this->handleFileUpload($socialLink['social_icon']) : null,
                    ];
                }
            }

            // Check for deleted social links
            foreach ($existingIndices as $index) {
                if (!array_key_exists($index, $submittedSocialLinks)) {
                    // This link is not in the submitted data, so it should be deleted
                    if (isset($existingSocialLinks[$index]['social_icon']) && file_exists(public_path('admin_assets/uploads/') . $existingSocialLinks[$index]['social_icon'])) {
                        $deletedImages[] = $existingSocialLinks[$index]['social_icon'];
                    }
                    // Remove from the existing list
                    unset($existingSocialLinks[$index]);
                }
            }

            // Remove images that are marked for deletion
            foreach ($deletedImages as $deletedImage) {
                $deletedImagePath = public_path('admin_assets/uploads/') . $deletedImage;
                if (file_exists($deletedImagePath)) {
                    @unlink($deletedImagePath);
                }
            }

            // Combine existing links and updated links, avoiding duplication
            $finalLinks = array_replace($existingSocialLinks, $updatedSocialLinks);
            $validated['social_links'] = array_values($finalLinks);

        } else {
            // If no social links are provided, delete all existing images and clear the database
            foreach ($existingSocialLinks as $existingSocialLink) {
                if (isset($existingSocialLink['social_icon']) && file_exists(public_path('admin_assets/uploads/') . $existingSocialLink['social_icon'])) {
                    @unlink(public_path('admin_assets/uploads/') . $existingSocialLink['social_icon']);
                }
            }
            $validated['social_links'] = [];
        }


        // Handle above footer section
        $existingAboveFooterSections = $themeOptions->above_footer_section;
        if (is_string($existingAboveFooterSections)) {
            $existingAboveFooterSections = json_decode($existingAboveFooterSections, true) ?? [];
        } else {
            $existingAboveFooterSections = $existingAboveFooterSections ?? [];
        }
        $updatedAboveFooterSections = [];
        $deletedImages = []; // Array to hold images to be deleted

        if ($request->has('above_footer_section')) {
            $submittedAboveFooterSections = $validated['above_footer_section'];

            // Create a map to track which indices are present in submitted data
            $submittedIndices = array_keys($submittedAboveFooterSections);
            $existingIndices = array_keys($existingAboveFooterSections);

            // Track the rows that need to be updated or added
            foreach ($submittedAboveFooterSections as $index => $section) {
                if (array_key_exists($index, $existingAboveFooterSections)) {
                    // Existing section; update it
                    $existingImage = $existingAboveFooterSections[$index]['fs_image'];

                    // Check if the submitted image is different from the existing one
                    if (isset($section['fs_image']) && $section['fs_image'] !== $existingImage) {
                        // Mark the old image for deletion
                        if ($existingImage && file_exists(public_path('admin_assets/uploads/') . $existingImage)) {
                            $deletedImages[] = $existingImage;
                        }
                        // Upload new image
                        $section['fs_image'] = $this->handleFileUpload($section['fs_image']);
                    } else {
                        // Keep the existing image if no new image is provided
                        $section['fs_image'] = $existingImage;
                    }

                    // Update the existing section
                    $updatedAboveFooterSections[$index] = [
                        'fs_title' => $section['fs_title'] ?? null,
                        'fs_description' => $section['fs_description'] ?? null,
                        'fs_image' => $section['fs_image'],
                    ];
                } else {
                    // New section; add it to the updated list
                    $updatedAboveFooterSections[$index] = [
                        'fs_title' => $section['fs_title'] ?? null,
                        'fs_description' => $section['fs_description'] ?? null,
                        'fs_image' => isset($section['fs_image']) ? $this->handleFileUpload($section['fs_image']) : null,
                    ];
                }
            }

            // Check for deleted sections
            foreach ($existingIndices as $index) {
                if (!array_key_exists($index, $submittedAboveFooterSections)) {
                    // This section is not in the submitted data, so it should be deleted
                    if (isset($existingAboveFooterSections[$index]['fs_image']) && file_exists(public_path('admin_assets/uploads/') . $existingAboveFooterSections[$index]['fs_image'])) {
                        $deletedImages[] = $existingAboveFooterSections[$index]['fs_image'];
                    }
                    // Remove from the existing list
                    unset($existingAboveFooterSections[$index]);
                }
            }

            // Remove images that are marked for deletion
            foreach ($deletedImages as $deletedImage) {
                $deletedImagePath = public_path('admin_assets/uploads/') . $deletedImage;
                if (file_exists($deletedImagePath)) {
                    @unlink($deletedImagePath);
                }
            }

            // Combine existing sections and updated sections, preserving order
            $finalSections = array_replace($existingAboveFooterSections, $updatedAboveFooterSections);
            $validated['above_footer_section'] = array_values($finalSections);
            $validated['top_header1_text'] = json_encode($validated['top_header1_texts']);

        } else {
            // If no new above footer sections are provided, delete all existing images
            foreach ($existingAboveFooterSections as $section) {
                if (isset($section['fs_image']) && file_exists(public_path('admin_assets/uploads/') . $section['fs_image'])) {
                    @unlink(public_path('admin_assets/uploads/') . $section['fs_image']);
                }
            }
            $validated['above_footer_section'] = [];
        }



        // Convert arrays to JSON for storage in a single column
        //dd($validated['social_links']);
        $validated['social_links'] = json_encode($validated['social_links'] ?? []);
        
        // Handle modal features
        $existingModalFeatures = is_array($themeOptions->modal_features) ? $themeOptions->modal_features : json_decode($themeOptions->modal_features, true) ?? [];
        $updatedModalFeatures = [];
        $deletedImages = [];

        if ($request->has('modal_features')) {
            $submittedModalFeatures = $validated['modal_features'];
            $submittedIndices = array_keys($submittedModalFeatures);
            $existingIndices = array_keys($existingModalFeatures);

            foreach ($submittedModalFeatures as $index => $feature) {
                if (array_key_exists($index, $existingModalFeatures)) {
                    $existingIcon = $existingModalFeatures[$index]['icon'] ?? null;
                    
                    if (isset($feature['icon']) && is_file($feature['icon'])) {
                        if ($existingIcon && file_exists(public_path('admin_assets/uploads/') . $existingIcon)) {
                            $deletedImages[] = $existingIcon;
                        }
                        $iconPath = $this->handleFileUpload($feature['icon']);
                    } else {
                        $iconPath = $existingIcon;
                    }
                } else {
                    $iconPath = isset($feature['icon']) && is_file($feature['icon']) ? $this->handleFileUpload($feature['icon']) : null;
                }

                $updatedModalFeatures[$index] = [
                    'icon' => $iconPath,
                    'title' => $feature['title'] ?? null,
                    'description' => $feature['description'] ?? null,
                ];
            }

            foreach ($existingIndices as $index) {
                if (!array_key_exists($index, $submittedModalFeatures)) {
                    if (isset($existingModalFeatures[$index]['icon']) && file_exists(public_path('admin_assets/uploads/') . $existingModalFeatures[$index]['icon'])) {
                        $deletedImages[] = $existingModalFeatures[$index]['icon'];
                    }
                }
            }

            foreach ($deletedImages as $deletedImage) {
                $deletedImagePath = public_path('admin_assets/uploads/') . $deletedImage;
                if (file_exists($deletedImagePath)) {
                    @unlink($deletedImagePath);
                }
            }

            $validated['modal_features'] = array_values($updatedModalFeatures);
        } else {
            foreach ($existingModalFeatures as $feature) {
                if (isset($feature['icon']) && file_exists(public_path('admin_assets/uploads/') . $feature['icon'])) {
                    @unlink(public_path('admin_assets/uploads/') . $feature['icon']);
                }
            }
            $validated['modal_features'] = [];
        }

        // Update the ThemeOption instance with validated data
        $themeOptions->update($validated);

        return redirect()->route('admin.theme-options')->with('success', 'Theme options updated successfully.');
    }

    // Validate data
    private function validateData(Request $request, $dataId = null)
    {
        return $request->validate([
            'top_header1_texts' => 'nullable|array',
            'top_header2_text' => 'nullable|string',
            'top_header2_text_price' => 'nullable|string',
            'mega_menu_banner' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'header_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'footer_description' => 'nullable|string',
            'social_links' => 'nullable|array',
            'social_links.*.social_icon' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'social_links.*.social_link_url' => 'nullable|url',
            'admin_email' => 'nullable|email',
            'admin_phone' => 'nullable|string|max:20',
            'footer_payment_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'footer_image1' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'footer_image2' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'above_footer_section' => 'nullable|array',
            'above_footer_section.*.fs_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'above_footer_section.*.fs_title' => 'nullable|string|max:255',
            'above_footer_section.*.fs_description' => 'nullable|string',
            'modal_title' => 'nullable|string|max:255',
            'modal_subtitle' => 'nullable|string|max:255',
            'modal_below_text' => 'nullable|string',
            'modal_features' => 'nullable|array|max:3',
            'modal_features.*.icon' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'modal_features.*.title' => 'nullable|string',
            'modal_features.*.description' => 'nullable|string',
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
    
}
