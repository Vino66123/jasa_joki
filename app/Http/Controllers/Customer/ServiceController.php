<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\Portfolio;
use App\Models\Testimonial;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::query();
        
        // Filtering
        if (request()->has('sort')) {
            switch(request('sort')) {
                case 'price_asc':
                    $services->orderBy('base_price', 'asc');
                    break;
                case 'price_desc':
                    $services->orderBy('base_price', 'desc');
                    break;
                case 'newest':
                    $services->latest();
                    break;
            }
        }
        
        $services = $services->paginate(9);
        
        return view('customer.services.index', compact('services'));
    }
    
    public function show(Service $service)
    {
        return view('customer.services.show', compact('service'));
    }
}
