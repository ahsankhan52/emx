<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Service;
use App\Models\Page;

class ServicesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 1. Clear existing services
        Service::truncate();

        // 2. Define Data
        $servicesData = [
            [
                'title' => 'General Diagnosis & Repair',
                'description' => 'Expert diagnosis and repair services covering Check Engine lights, Transmission systems, and comprehensive vehicle troubleshooting. We identify the root cause of issues to ensure reliable repairs.',
                'image' => ''
            ],
            [
                'title' => 'Service & Maintenance',
                'description' => 'Routine service and maintenance to keep your vehicle running smoothly. From oil changes to fluid checks, we ensure your car remains in peak condition.',
                'image' => ''
            ],
            [
                'title' => 'Safety Systems (ABS / SRS)',
                'description' => 'Specialized repair for safety-critical systems including ABS (Anti-lock Braking System), Traction Control, and SRS (Airbag) systems to ensure your safety on the road.',
                'image' => ''
            ],
            [
                'title' => 'Climate & Comfort',
                'description' => 'Full service for AC Climate Control systems, Windows, Locking Systems, and Convertible Top repairs. We ensure your driving experience is comfortable and functional.',
                'image' => ''
            ],
            [
                'title' => 'Suspension & Chassis',
                'description' => 'Diagnosis and repair of Suspension systems, shocks, struts, and steering components to maintain optimal handling and ride comfort.',
                'image' => ''
            ],
            [
                'title' => 'Electrical & Lighting',
                'description' => 'Complete Electrical System diagnosis and repair. We handle Lightning Systems, wiring issues, and complex electrical faults.',
                'image' => ''
            ],
            [
                'title' => 'Security & Immobilizer',
                'description' => 'Services for Immobilizer systems, Alarms, and security modules. We handle Ignition switches (EIS/CAS) and Steering column lock modules.',
                'image' => ''
            ],
            [
                'title' => 'Programming & Coding',
                'description' => 'Advanced Online and Offline programming services. Key and Module coding/programming for a wide range of vehicle makes and models.',
                'image' => ''
            ],
            [
                'title' => 'Module Repairs',
                'description' => 'Specialized component-level repair for vehicle modules including FRM, BCM, ECM/DME, SRS, and Transmission & Shifter modules (ISM/DSM).',
                'image' => ''
            ],
            [
                'title' => 'ADAS Calibrations',
                'description' => 'Calibration of Advanced Driver Assistance Systems (ADAS) including Front Radar (ACC), Pre-Collision, ParkAssist, Surround-view Cameras, and Blind Spot Monitoring (BSM).',
                'image' => ''
            ],
        ];

        // 3. Insert Services
        foreach ($servicesData as $data) {
            Service::create($data);
        }

        // 4. Update Services Page Content
        $page = Page::where('slug', 'services')->first();
        if ($page) {
            $content = $page->content ?? [];

            // Context formatting
            $description = "We provide expert diagnosis and repairs for specific systems and routine maintenance for Asian, American, and European cars. " .
                "Our capabilities extend to all vehicle types including regular cars, Hybrids, Electric vehicles (EVs), Exotics, and Hyper cars. " .
                "From module repairs to ADAS calibrations, we are your trusted partner for advanced auto repair.";

            $content['banner_title'] = 'Our Services';
            $content['banner_description'] = $description;
            // $content['banner_image'] = ''; // Keep existing if set

            $page->update([
                'content' => $content,
                'seo_title' => 'Services - EMX Auto Repair',
                'seo_description' => 'Comprehensive auto repair services: Diagnosis, Maintenance, ADAS Calibration, Module Programming, and more for all car types.'
            ]);
        }
    }
}
