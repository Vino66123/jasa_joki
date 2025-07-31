<?php

namespace Database\Seeders;

use App\Models\Portfolio;
use App\Models\Service;
use Illuminate\Database\Seeder;

class PortfolioSeeder extends Seeder
{
    public function run()
{
    $services = Service::all();
    
    $portfolios = [
        [
            'title' => 'Website E-Commerce Fashion',
            'description' => '...',
            'image_url' => '...',
            'url' => '...',
            'service_type' => 'ecommerce', // Gunakan key baru
            'completed_date' => now()->subMonths(3)
        ],
        // Data lainnya...
    ];

    foreach ($portfolios as $data) {
        $service = $this->findMatchingService($services, $data['service_type']);
        
        if ($service) {
            Portfolio::create([
                'title' => $data['title'],
                'description' => $data['description'],
                'image_url' => $data['image_url'],
                'url' => $data['url'],
                'service_id' => $service->id,
                'completed_date' => $data['completed_date']
            ]);
        }
    }
}

protected function findMatchingService($services, $type)
{
    $map = [
        'ecommerce' => 'E-Commerce',
        'company' => 'Company Profile',
        'landing' => 'Landing Page',
        'school' => 'Website Sekolah',
        'webapp' => 'Web App',
        'personal' => 'Personal Website'
    ];
    
    $searchTerm = $map[$type] ?? $type;
    
    return $services->first(function ($service) use ($searchTerm) {
        return stripos($service->name, $searchTerm) !== false;
    });
}
}