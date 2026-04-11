<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ThemeOptionSeeder extends Seeder
{
    public function run(): void
    {
        $exists = DB::table('theme_options')->exists();

        if (!$exists) {
            DB::table('theme_options')->insert([
                'top_header1_text'       => json_encode([['text' => 'Free Shipping on orders above ₹999']]),
                'footer_description'     => '5Petal is a premium fashion brand offering handcrafted sarees and ethnic wear.',
                'social_links'           => json_encode([]),
                'admin_email'            => 'support@5petal.com',
                'admin_phone'            => '9999999999',
                'footer_payment_logo'    => null,
                'footer_image1'          => null,
                'footer_image2'          => null,
                'mega_menu_banner'       => null,
                'header_logo'            => null,
                'above_footer_section'   => json_encode([]),
                'modal_features'         => json_encode([]),
                'modal_title'            => null,
                'modal_subtitle'         => null,
                'modal_below_text'       => null,
                'created_at'             => now(),
                'updated_at'             => now(),
            ]);
        }
    }
}
