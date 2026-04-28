<?php

namespace App\Http\Controllers\Pelaggan;

use App\Http\Controllers\Controller;
use App\Models\Package;
use App\Models\Booking;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Transaction;
use Illuminate\Support\Facades\DB;

class BookingController extends Controller
{
public function index(Request $request)
{
    if (!$request->package_id) {
        return redirect('/')->with('error', 'Pilih paket dulu');
    }

    $package = Package::with('includes')->findOrFail($request->package_id);

    // 🔥 TAMBAHAN INI
    $additionals = Package::where('category_id', 7)->get();

    $weddingDates = Booking::whereNotIn('status', ['cancelled','rejected'])
        ->whereNotNull('booking_date')
        ->pluck('booking_date')
        ->map(fn($d) => Carbon::parse($d)->format('Y-m-d'))
        ->toArray();

    $prewedDates = Booking::whereNotIn('status', ['cancelled','rejected'])
        ->whereNotNull('prewedding_date')
        ->pluck('prewedding_date')
        ->map(fn($d) => Carbon::parse($d)->format('Y-m-d'))
        ->toArray();

    $prewedTimes = Booking::whereNotIn('status', ['cancelled','rejected'])
        ->whereNotNull('prewedding_date')
        ->get()
        ->groupBy(fn($b) => Carbon::parse($b->prewedding_date)->format('Y-m-d'))
        ->map(fn($items) => $items->pluck('prewedding_time')
            ->map(fn($time) => substr($time, 0, 5))
            ->toArray()
        );

    return view('pelanggan.booking', compact(
        'package',
        'additionals', // 🔥 INI PENTING
        'weddingDates',
        'prewedDates',
        'prewedTimes'
    ));
}
    public function store(Request $request)
    {
        $package = Package::findOrFail($request->package_id);
        $inc = $package->includes->pluck('type')->toArray();

        // ================= VALIDATION =================
        $rules = [
            'package_id'       => 'required|exists:packages,id',
            'customer_name'    => 'required|string|max:255',
            'customer_phone'   => 'required|numeric|digits_between:10,15',
            'customer_email'   => 'required|email',
            'customer_address' => 'required|string|min:10',

            // FIX: booking_fee ditambahin
            'payment_type'     => 'required|in:booking_fee,dp,full',

            // FIX: harus ada di form juga
            'transport_fee'    => 'nullable|numeric|min:0',
            'additional_fee'   => 'nullable|numeric|min:0',
        ];

        if (in_array('wedding', $inc)) {
            $rules['wedding_date'] = 'required|date|after:today';
        }

        if (in_array('prewedding', $inc)) {
            $rules['prewedding_date'] = 'required|date|before:wedding_date|different:wedding_date';
            $rules['prewedding_category'] = 'required|in:indoor,outdoor';
        }

        if (in_array('engagement', $inc)) {
            $rules['engagement_date'] = 'required|date|after:today';
        }

        $request->validate($rules);

        // ================= TANGGAL UTAMA =================
        $mainDate = $request->wedding_date 
            ?? $request->engagement_date 
            ?? $request->prewedding_date;

        // ================= HITUNG BIAYA =================
        $transport = $request->transport_fee ?? 0;
        $additional = $request->additional_fee ?? 0;

        $totalPrice = $package->price + $transport + $additional;

        // booking_fee = 1jt fix
        if ($request->payment_type === 'booking_fee') {
            $amountPaid = 1000000;
        } elseif ($request->payment_type === 'dp') {
            $amountPaid = $totalPrice * 0.5;
        } else {
            $amountPaid = $totalPrice;
        }

        $remaining = $totalPrice - $amountPaid;

        $status = $request->payment_method === 'qris'
            ? 'waiting_confirmation'
            : 'pending';

        // ================= SIMPAN =================
        $booking = Booking::create([
            'user_id'          => auth()->check() ? auth()->id() : null,
            'package_id'       => $package->id,

            'customer_name'    => $request->customer_name,
            'customer_phone'   => $request->customer_phone,
            'customer_email'   => $request->customer_email,
            'customer_address' => $request->customer_address,

            'booking_date'     => $mainDate,

            // prewedding
            'prewedding_date'      => $request->prewedding_date,
            'prewedding_category'  => $request->prewedding_category,
            'prewedding_time'      => $request->prewedding_time,
            'prewedding_location'  => $request->prewedding_location,

            // wedding
            'wedding_time'         => $request->wedding_time,
            'wedding_location'     => $request->wedding_location,

            // biaya
            'transport_fee'        => $transport,
            'additional_fee'       => $additional,

            // pembayaran
            'payment_type'     => $request->payment_type,

            'total_price'      => $totalPrice,
            'amount_paid'      => $amountPaid,
            'remaining'        => $remaining,

            'status'           => $status,
            'expired_at'       => now()->addHours(24),
        ]);

        return redirect('/')
    ->with('success', 'Booking berhasil! Admin akan menghubungi via WhatsApp.');
    }

}