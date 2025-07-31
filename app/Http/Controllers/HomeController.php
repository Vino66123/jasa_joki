<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\Portfolio;
use App\Models\Testimonial;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index ()
    {
        $popularServices = Service::orderBy('delivery_time', 'desc')->take(3)->get();
        $portfolios = Portfolio::latest()->take(6)->get();
        $testimonials = Testimonial::with('user')->latest()->take(3)->get();
        
        return view('customer.home', compact('popularServices', 'portfolios', 'testimonials'));
    }
}
