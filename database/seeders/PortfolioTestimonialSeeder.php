<?php

namespace Database\Seeders;

use App\Models\Portfolio;
use App\Models\Testimonial;
use App\Models\User;
use App\Models\Order;
use App\Models\Service;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class PortfolioTestimonialSeeder extends Seeder
{
    public function run()
    {
        // Pastikan ada minimal 1 service
        if (Service::count() == 0) {
            Service::create([
                'name' => 'E-Commerce',
                'slug' => 'e-commerce',
                'description' => 'Jasa pembuatan website toko online',
                'base_price' => 2000000,
                'delivery_time' => 14,
                'is_active' => true,
            ]);
            Service::create([
                'name' => 'Company Profile',
                'slug' => 'company-profile',
                'description' => 'Jasa pembuatan website profil perusahaan',
                'base_price' => 1500000,
                'delivery_time' => 10,
                'is_active' => true,
            ]);
            Service::create([
                'name' => 'Landing Page',
                'slug' => 'landing-page',
                'description' => 'Jasa pembuatan landing page profesional',
                'base_price' => 1000000,
                'delivery_time' => 7,
                'is_active' => true,
            ]);
        }
        $services = Service::all();

        // Pastikan ada minimal 3 user customer
        if (User::where('role', 'customer')->count() < 3) {
            for ($i = 1; $i <= 3; $i++) {
                User::create([
                    'name' => 'Customer ' . $i,
                    'email' => 'customer' . $i . '@example.com',
                    'password' => Hash::make('password'),
                    'role' => 'customer',
                ]);
            }
        }
        $users = User::where('role', 'customer')->get();

        // Pastikan ada minimal 3 order
        if (Order::count() < 3) {
            foreach ($users as $index => $user) {
                Order::create([
                    'order_code' => 'ORD' . str_pad($index + 1, 4, '0', STR_PAD_LEFT),
                    'user_id' => $user->id,
                    'service_id' => $services[$index % $services->count()]->id,
                    'requirements' => 'Kebutuhan website untuk ' . $user->name,
                    'status' => 'completed',
                    'total_price' => $services[$index % $services->count()]->base_price,
                    'deadline' => now()->addWeeks(2),
                    'admin_notes' => null,
                ]);
            }
        }
        $orders = Order::all();

        // Portfolio Samples
        $serviceEcommerce = $services->where('name', 'like', '%E-Commerce%')->first();
        $serviceCompany = $services->where('name', 'like', '%Company Profile%')->first();
        $serviceLanding = $services->where('name', 'like', '%Landing Page%')->first();

        $portfolios = [];
        if ($serviceEcommerce && isset($users[0])) {
            $portfolios[] = [
                'title' => 'Website E-Commerce Toko Baju',
                'description' => 'Website e-commerce dengan fitur lengkap untuk toko baju online',
                'image_url' => 'https://example.com/images/portfolio1.jpg',
                'url' => 'https://tokobaju.example.com',
                'service_id' => $serviceEcommerce->id,
                'completed_date' => now()->subMonths(2),
                'user_id' => $users[0]->id,
            ];
        }
        if ($serviceCompany && isset($users[1])) {
            $portfolios[] = [
                'title' => 'Company Profile PT. Maju Jaya',
                'description' => 'Website perusahaan dengan tampilan profesional dan responsive',
                'image_url' => 'https://example.com/images/portfolio2.jpg',
                'url' => 'https://majujaya.example.com',
                'service_id' => $serviceCompany->id,
                'completed_date' => now()->subMonths(4),
                'user_id' => $users[1]->id,
            ];
        }
        if ($serviceLanding && isset($users[2])) {
            $portfolios[] = [
                'title' => 'Landing Page Startup Tech',
                'description' => 'Landing page modern untuk produk teknologi baru',
                'image_url' => 'https://example.com/images/portfolio3.jpg',
                'url' => 'https://techstartup.example.com',
                'service_id' => $serviceLanding->id,
                'completed_date' => now()->subMonth(),
                'user_id' => $users[2]->id,
            ];
        }

        foreach ($portfolios as $portfolio) {
            Portfolio::create($portfolio);
        }

        // Testimonial Samples
        $testimonials = [];
        if (isset($users[0], $orders[0])) {
            $testimonials[] = [
                'user_id' => $users[0]->id,
                'order_id' => $orders[0]->id,
                'rating' => 5,
                'comment' => 'Pelayanan sangat memuaskan, website sesuai dengan yang saya inginkan!',
                'is_approved' => true
            ];
        }
        if (isset($users[1], $orders[1])) {
            $testimonials[] = [
                'user_id' => $users[1]->id,
                'order_id' => $orders[1]->id,
                'rating' => 4,
                'comment' => 'Pengerjaan cepat dan hasilnya bagus, hanya ada sedikit revisi',
                'is_approved' => true
            ];
        }
        if (isset($users[2], $orders[2])) {
            $testimonials[] = [
                'user_id' => $users[2]->id,
                'order_id' => $orders[2]->id,
                'rating' => 5,
                'comment' => 'Tim sangat profesional, akan order lagi untuk project berikutnya',
                'is_approved' => true
            ];
        }

        foreach ($testimonials as $testimonial) {
            Testimonial::create($testimonial);
        }
    }
}