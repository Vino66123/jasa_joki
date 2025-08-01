<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function dashboard()
    {
        // $orders = auth()->user()->orders()->with('service')->latest()->get();
        return view('customer.dashboard');
    }
}
