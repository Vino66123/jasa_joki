<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class AdminOrdersController extends Controller
{
    public function index()
    {
        // $order = Order::with('user')->first();
        // dd($order);
        // Logic to fetch and display all orders for admin
        $orders = Order::with(['user', 'service'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);
            // dd($orders);
        return view('admin.orders.index', compact('orders'));
    }
}
