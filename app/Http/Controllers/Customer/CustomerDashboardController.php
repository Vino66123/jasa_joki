<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Payment;
use App\Models\Service;
use Illuminate\Http\Request;

class CustomerDashboardController extends Controller
{
    /**
     * Menampilkan dashboard customer
     */
    public function index()
    {
        $user = auth()->user();
        
        // Data statistik
        $stats = [
            'total_orders' => $user->orders()->count(),
            'completed_orders' => $user->orders()->where('status', 'completed')->count(),
            'pending_orders' => $user->orders()->where('status', 'pending')->count(),
            'total_spent' => $user->orders()->where('status', 'completed')->sum('total_price')
        ];
        
        // Pesanan terbaru
        $recentOrders = $user->orders()
                            ->with(['service', 'payments'])
                            ->latest()
                            ->take(5)
                            ->get();
        
        // Rekomendasi layanan berdasarkan histori order
        $recommendedServices = Service::whereNotIn('id', $user->orders()->pluck('service_id'))
                                    ->inRandomOrder()
                                    ->limit(3)
                                    ->get();
        
        return view('customer.dashboard.index', compact('stats', 'recentOrders', 'recommendedServices'));
    }

    /**
     * Menampilkan detail pesanan
     */
    public function showOrder($id)
    {
        $order = Order::with(['service', 'payments', 'progresses'])
                    ->where('user_id', auth()->id())
                    ->findOrFail($id);
        
        return view('customer.dashboard.order-detail', compact('order'));
    }

    /**
     * Menampilkan form untuk membuat pesanan baru
     */
    public function createOrder()
    {
        $services = Service::active()->get();
        return view('customer.dashboard.create-order', compact('services'));
    }

    /**
     * Menyimpan pesanan baru
     */
    public function storeOrder(Request $request)
    {
        $validated = $request->validate([
            'service_id' => 'required|exists:services,id',
            'requirements' => 'required|string|min:20',
            'deadline' => 'nullable|date|after:today'
        ]);
        
        $service = Service::find($validated['service_id']);
        
        $order = Order::create([
            'user_id' => auth()->id(),
            'service_id' => $service->id,
            'requirements' => $validated['requirements'],
            'deadline' => $validated['deadline'],
            'total_price' => $service->base_price,
            'status' => 'pending'
        ]);
        
        return redirect()->route('customer.dashboard.order-detail', $order->id)
                        ->with('success', 'Pesanan berhasil dibuat! Silakan lakukan pembayaran.');
    }

    /**
     * Menampilkan riwayat pesanan
     */
    public function orderHistory()
    {
        $orders = auth()->user()
                      ->orders()
                      ->with(['service', 'payments'])
                      ->latest()
                      ->paginate(10);
        
        return view('customer.dashboard.order-history', compact('orders'));
    }

    /**
     * Menampilkan halaman pembayaran
     */
    public function showPayment($orderId)
    {
        $order = Order::where('user_id', auth()->id())
                     ->findOrFail($orderId);
        
        // Jika sudah ada pembayaran yang sukses
        if ($order->payments()->where('status', 'paid')->exists()) {
            return redirect()->route('customer.dashboard.order-detail', $order->id)
                            ->with('info', 'Pesanan ini sudah dibayar');
        }
        
        return view('customer.dashboard.payment', compact('order'));
    }

    /**
     * Memproses pembayaran
     */
    public function processPayment(Request $request, $orderId)
    {
        $validated = $request->validate([
            'payment_method' => 'required|in:bank_transfer,ewallet,credit_card',
            'proof' => 'required_if:payment_method,bank_transfer|image|max:2048'
        ]);
        
        $order = Order::where('user_id', auth()->id())
                     ->findOrFail($orderId);
        
        // Simpan pembayaran
        $payment = new Payment([
            'order_id' => $order->id,
            'amount' => $order->total_price,
            'payment_method' => $validated['payment_method'],
            'status' => $validated['payment_method'] === 'bank_transfer' ? 'pending' : 'paid'
        ]);
        
        if ($request->hasFile('proof')) {
            $path = $request->file('proof')->store('payment-proofs', 'public');
            $payment->proof = $path;
        }
        
        $payment->save();
        
        // Update status order jika pembayaran langsung diterima
        if ($payment->status === 'paid') {
            $order->update(['status' => 'processing']);
        }
        
        return redirect()->route('customer.dashboard.order-detail', $order->id)
                        ->with('success', 'Pembayaran berhasil diproses!');
    }

    /**
     * Menampilkan halaman testimoni
     */
    public function createTestimonial($orderId)
    {
        $order = Order::where('user_id', auth()->id())
                     ->where('status', 'completed')
                     ->findOrFail($orderId);
        
        // Cek apakah sudah memberikan testimoni
        if ($order->testimonial) {
            return redirect()->route('customer.dashboard.order-detail', $order->id)
                            ->with('info', 'Anda sudah memberikan testimoni untuk pesanan ini');
        }
        
        return view('customer.dashboard.create-testimonial', compact('order'));
    }

    /**
     * Menyimpan testimoni
     */
    public function storeTestimonial(Request $request, $orderId)
    {
        $validated = $request->validate([
            'rating' => 'required|integer|between:1,5',
            'comment' => 'required|string|min:10|max:500'
        ]);
        
        $order = Order::where('user_id', auth()->id())
                     ->where('status', 'completed')
                     ->findOrFail($orderId);
        
        $order->testimonial()->create([
            'user_id' => auth()->id(),
            'rating' => $validated['rating'],
            'comment' => $validated['comment'],
            'is_approved' => false // Menunggu persetujuan admin
        ]);
        
        return redirect()->route('customer.dashboard.order-detail', $order->id)
                        ->with('success', 'Terima kasih atas testimoni Anda!');
    }
}