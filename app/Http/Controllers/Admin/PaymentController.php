<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\payment;

use Illuminate\Http\Request;

class PaymentController extends Controller
{
      public function index()
    {
        $pembayaran = Payment::with('order.user')->get();
        // dd($pembayaran);
        return view('admin.payment.index', compact('pembayaran'));
    }

    public function update(Request $request, $id)
    {
        $payment = Payment::findOrFail($id);
        $payment->status = $request->status;
        $payment->save();

        // Update order jika relasi sudah dibuat
        if ($payment->order) {
            if ($request->status === 'paid') {
                $payment->order->status = 'processing';
            } elseif ($request->status === 'expired') {
                $payment->order->status = 'cancelled';
            }
            $payment->order->save();
        }

        return redirect()->route('admin.payments.index')->with('success', 'Status pembayaran dan order berhasil diperbarui.');
    }
}
