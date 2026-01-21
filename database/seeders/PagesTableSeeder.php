<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Page;

class PagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $pages = [
            ['slug' => 'home', 'name' => 'Home Page'],
            ['slug' => 'about', 'name' => 'About Us'],
            ['slug' => 'services', 'name' => 'Services'],
            ['slug' => 'location', 'name' => 'Location'],
            ['slug' => 'contact', 'name' => 'Contact Us'],
            ['slug' => 'terms', 'name' => 'Terms & Conditions'],
            ['slug' => 'privacy', 'name' => 'Privacy Policy'],
        ];

        foreach ($pages as $page) {
            Page::firstOrCreate(
                ['slug' => $page['slug']],
                [
                    'name' => $page['name'],
                    'content' => [], // Empty JSON object initially
                    'seo_title' => $page['name'] . ' - EMX Auto Repair',
                    'seo_description' => 'Welcome to EMX Auto Repair.',
                ]
            );
        }
    }
}
