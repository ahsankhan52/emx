<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Page;

class PageContentSeeder extends Seeder
{
    public function run()
    {
        $homeContent = [
            'hero_title' => 'Expert Auto Repair {You Can Trust}',
            'hero_description' => 'Professional diagnosis and repair services for all makes and models. Fast, reliable, and affordable automotive solutions since 2001.',
            'hero_image' => '', // Will use default if empty
            'about_title' => 'Decades of {Excellence} in Auto Repair',
            'about_description' => '<p>At EMX Auto Diagnosis and Repair, we\'ve been serving our community with top-quality automotive services for over two decades. Our experienced team of certified technicians uses state-of-the-art diagnostic equipment to identify and fix issues quickly and accurately.</p><p>We pride ourselves on honest service, fair pricing, and getting you back on the road safely. Whether it\'s routine maintenance or complex engine repair, we treat every vehicle with the care and attention it deserves.</p>',
            'about_image' => '',
            'services_title' => 'Our Services',
            'services_description' => 'Comprehensive automotive repair and maintenance services for all your vehicle needs.',
            'reviews_title' => 'What Our Customers Say',
            'reviews_description' => 'Don\'t just take our word for it - hear from satisfied customers.',
            'location_title' => 'Visit Our Shop',
            'location_description' => 'Located conveniently for easy access and quick service.'
        ];

        Page::where('slug', 'home')->update(['content' => $homeContent]);

        // Seed some basic content for internal pages too
        Page::where('slug', 'about')->update([
            'content' => [
                'banner_title' => 'About EMX Auto',
                'banner_description' => 'Learn about our history and commitment to quality.',
                'section_1_title' => 'Our Legacy',
                'section_1_content' => 'Founded in 2001, EMX Auto has grown from a small family shop to a leading diagnosis center.'
            ]
        ]);
    }
}
