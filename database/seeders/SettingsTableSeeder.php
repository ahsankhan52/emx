<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Setting;

class SettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $settings = [
            'company_name' => 'EMX Auto Diagnosis & Repair',
            'site_title' => 'EMX Auto Diagnosis and Repair',
            'site_description' => 'Professional Auto Repair Services',
            'email' => 'info@emxauto.com',
            'address' => '123 Main St, Anytown, USA',
            'location_link' => 'https://www.google.com/maps',
            'phone_numbers' => json_encode([
                ['label' => 'Office', 'number' => '818-330-9970']
            ]),
            'business_hours' => json_encode([
                'Monday' => ['active' => true, 'start' => '07:00', 'end' => '18:00'],
                'Tuesday' => ['active' => true, 'start' => '07:00', 'end' => '18:00'],
                'Wednesday' => ['active' => true, 'start' => '07:00', 'end' => '18:00'],
                'Thursday' => ['active' => true, 'start' => '07:00', 'end' => '18:00'],
                'Friday' => ['active' => true, 'start' => '07:00', 'end' => '18:00'],
                'Saturday' => ['active' => true, 'start' => '08:00', 'end' => '16:00'],
                'Sunday' => ['active' => false, 'start' => '', 'end' => ''],
            ]),
            'social_links' => json_encode([
                'Facebook' => ['active' => true, 'url' => 'https://facebook.com/emxauto'],
                'Instagram' => ['active' => true, 'url' => 'https://instagram.com/emxauto'],
                'LinkedIn' => ['active' => false, 'url' => ''],
                'Twitter' => ['active' => false, 'url' => ''],
                'YouTube' => ['active' => false, 'url' => ''],
            ]),
            'footer_text' => '<p>&copy; 2026 EMX Auto Repair. All rights reserved.</p>',
            'logo' => '',
            'favicon' => ''
        ];

        foreach ($settings as $key => $value) {
            Setting::updateOrCreate(
                ['key' => $key],
                ['value' => $value]
            );
        }
    }
}
