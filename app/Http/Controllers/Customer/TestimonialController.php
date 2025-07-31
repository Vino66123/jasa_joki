<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use Illuminate\Http\Request;

class TestimonialController extends Controller
{
    public function index()
    {
        $testimonials = Testimonial::with('user')
                        ->where('is_approved', true)
                        ->latest()
                        ->limit(5)
                        ->get();
                        
        return view('customer.testimonial.index', compact('testimonials'));
    }
}
