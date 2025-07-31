<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Service;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $services = [
            ['name' => 'Website E-Commerce', 'description' => '...', 'base_price' => 5000000],
            ['name' => 'Company Profile', 'description' => '...', 'base_price' => 3000000],
            ['name' => 'Landing Page', 'description' => '...', 'base_price' => 1500000],
            ['name' => 'Website Sekolah', 'description' => '...', 'base_price' => 4000000],
            ['name' => 'Web App Custom', 'description' => '...', 'base_price' => 7000000],
            ['name' => 'Personal Website', 'description' => '...', 'base_price' => 2500000]
        ];

        foreach ($services as $service) {
            Service::create($service);
        }
    }
}
