<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Service;

class ServiceSeeder extends Seeder
{
    public function run(): void
    {
        $services = [
            // Standard Services
            [
                'title' => 'Half Body Massage',
                'description' => 'Targeted traditional Malay massage focusing on specific high-tension areas (e.g., upper back, shoulders, or legs) for quick strain relief.',
                'duration_minutes' => 45,
                'price' => 50.00,
            ],

            // Mawar Package
            [
                'title' => 'Mawar Package (3 Days)',
                'description' => 'Basic therapeutic postpartum care including full body massage and warm herbal cream application. Suitable for both normal and C-section delivery.',
                'duration_minutes' => 90,
                'price' => 330.00,
            ],
            [
                'title' => 'Mawar Package (5 Days)',
                'description' => '5-day therapeutic postpartum care package featuring daily full body massage and warm herbal cream application.',
                'duration_minutes' => 90,
                'price' => 550.00,
            ],
            [
                'title' => 'Mawar Package (7 Days)',
                'description' => 'Comprehensive 7-day postpartum recovery package with daily full body massage and warm herbal cream application.',
                'duration_minutes' => 90,
                'price' => 770.00,
            ],

            // Tanjung Package
            [
                'title' => 'Tanjung Package (3 Days)',
                'description' => '3-day essential maternal package including full body massage, Param, Pilis, Bertungku, Tepel Perut, Berbengkung, plus baby bath and baby massage.',
                'duration_minutes' => 120,
                'price' => 450.00,
            ],
            [
                'title' => 'Tanjung Package (5 Days)',
                'description' => '5-day maternal wellness package with massage, Param, Pilis, Bertungku, abdominal bind (Berbengkung), Tepel Perut, and full infant care (mandi & urut baby).',
                'duration_minutes' => 120,
                'price' => 750.00,
            ],
            [
                'title' => 'Tanjung Package (7 Days)',
                'description' => 'Full 7-day traditional confinement package including full body massage, herbal Param & Pilis, Bertungku, Tepel Perut, Berbengkung, and daily baby bath & massage.',
                'duration_minutes' => 120,
                'price' => 1050.00,
            ],

            // Kemboja Package
            [
                'title' => 'Kemboja Package (3 Days)',
                'description' => '3-day complete confinement therapy featuring full body massage, Param, Pilis, Berbengkung, Tepel Perut, Bertungku, mother herbal bath (Mandi Herba), and baby bath & massage.',
                'duration_minutes' => 150,
                'price' => 540.00,
            ],
            [
                'title' => 'Kemboja Package (5 Days)',
                'description' => '5-day premium confinement therapy with traditional massage, herbal application (Param & Pilis), bengkung wrapping, herbal steam bath for mother, and full baby care.',
                'duration_minutes' => 150,
                'price' => 900.00,
            ],
            [
                'title' => 'Kemboja Package (7 Days)',
                'description' => '7-day luxury restorative confinement treatment including full body massage, Param, Pilis, Berbengkung, Tepel Perut, Bertungku, herbal baths for mother, and daily infant care.',
                'duration_minutes' => 150,
                'price' => 1260.00,
            ],

            // Rose Package
            [
                'title' => 'Rose Package (7 Days)',
                'description' => 'Ultimate 7-day royal maternal treatment package featuring full body massage, Param, Pilis, Tepel Perut, Bengkung, mother herbal bath, infant care (mandi & urut baby), 1x Herbal Sauna, and 1x Tangas session.',
                'duration_minutes' => 180,
                'price' => 1400.00,
            ],
        ];

        foreach ($services as $service) {
            Service::updateOrCreate(['title' => $service['title']], $service);
        }
    }
}