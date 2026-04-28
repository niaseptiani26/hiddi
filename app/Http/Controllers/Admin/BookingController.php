<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Package;


class BookingController extends Controller
{
    /**
     * List semua booking
     */
public function index(Request $request)
{
    $query = Booking::with(['user', 'package']);
$packages = Package::all();
    // FILTER NAMA
    if ($request->name) {
        $query->where(function ($q) use ($request) {
            $q->where('customer_name', 'like', '%' . $request->name . '%')
              ->orWhereHas('user', function ($uq) use ($request) {
                  $uq->where('name', 'like', '%' . $request->name . '%');
              });
        });
    }

    // FILTER TANGGAL
    if ($request->date) {
        $query->whereDate('booking_date', $request->date);
    }
if ($request->package_id) {
    $query->where('package_id', $request->package_id);
}
    $bookings = $query->latest()->get();
    

return view('admin.bookings.index', compact('bookings', 'packages'));
}

    /**
     * Detail booking
     */
    public function show($id)
    {
        $booking = Booking::with([
            'user',
            'package',
            'transaction',
            'histories.user'
        ])->findOrFail($id);

        return view('admin.bookings.show', compact('booking'));
    }

    /**
     * Update status booking
     */
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,dp_paid,paid,completed,cancelled'
        ]);

        $booking = Booking::findOrFail($id);

        $booking->update([
            'status' => $request->status
        ]);

        // simpan history
        $booking->histories()->create([
            'status' => $request->status,
            'changed_by' => auth()->id(),
            'note' => $request->note
        ]);

        return back()->with('success','Status booking diperbarui');
    }

    /**
     * Cancel booking
     */
    public function cancel($id)
    {
        $booking = Booking::findOrFail($id);

        $booking->update([
            'status' => 'cancelled'
        ]);

        $booking->histories()->create([
            'status' => 'cancelled',
            'changed_by' => auth()->id(),
            'note' => 'Dibatalkan oleh admin'
        ]);

        return back()->with('success','Booking dibatalkan');
    }
    
}