<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ThemeOption;

class ThemeOptionController extends Controller
{
    // Fetch and return all theme options
    public function getThemeOptions()
    {
        // Retrieve the first theme option record
        $themeOptions = ThemeOption::first();

        // If no theme options exist return empty response
        if (!$themeOptions) {
            return response()->json([
                'success' => false,
                'message' => 'No theme options found.',
                'data'    => null
            ], 200);
        }

        // Helper to safely build asset URL only if not already a full URL
        $buildUrl = function($value) {
            if (empty($value) || str_starts_with($value, 'http')) {
                return $value;
            }
            return asset('admin_assets/uploads/' . $value);
        };

        $themeOptions->mega_menu_banner   = $buildUrl($themeOptions->mega_menu_banner);
        $themeOptions->header_logo        = $buildUrl($themeOptions->header_logo);
        $themeOptions->footer_payment_logo = $buildUrl($themeOptions->footer_payment_logo);
        $themeOptions->footer_image1      = $buildUrl($themeOptions->footer_image1);
        $themeOptions->footer_image2      = $buildUrl($themeOptions->footer_image2);

        // Handle 'social_links' JSON field and update image paths
        $socialLinks = [];
        if ($themeOptions->social_links) {
            $decoded = is_string($themeOptions->social_links) ? json_decode($themeOptions->social_links, true) : $themeOptions->social_links;
            if (is_array($decoded)) {
                foreach ($decoded as &$link) {
                    $link['social_icon'] = $buildUrl($link['social_icon'] ?? null);
                }
                $socialLinks = $decoded;
            }
        }
        $themeOptions->social_links = $socialLinks;

        // Handle 'above_footer_section' JSON field and update image paths
        if($themeOptions->above_footer_section) {
            $footerSections = is_array($themeOptions->above_footer_section) ? $themeOptions->above_footer_section : json_decode($themeOptions->above_footer_section, true);
            foreach ($footerSections as &$section) {
                $section['fs_image'] = $buildUrl($section['fs_image'] ?? null);
            }
            $themeOptions->above_footer_section = $footerSections;
        }

        // Handle 'modal_features' JSON field and update image paths
        if($themeOptions->modal_features) {
            $modalFeatures = is_array($themeOptions->modal_features) ? $themeOptions->modal_features : json_decode($themeOptions->modal_features, true);
            foreach ($modalFeatures as &$feature) {
                $feature['icon'] = $buildUrl($feature['icon'] ?? null);
            }
            $themeOptions->modal_features = $modalFeatures;
        }

        // Return the data as a JSON response
        return response()->json([
            'success' => true,
            'message' => 'Theme Options retrieved successfully.',
            'data' => $themeOptions
        ], 200);
    }
}
