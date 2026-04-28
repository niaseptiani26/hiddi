<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Portfolio;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // TOTAL BOOKING
        $totalBooking = Booking::count();

        // TOTAL REVENUE
        $totalRevenue = Booking::where('status', 'paid')->sum('total_price');

        // TOTAL PORTFOLIO
        $totalPortfolio = Portfolio::count();

        // BOOKING HARI INI
        $recentBookings = Booking::with('package')
            ->whereDate('created_at', Carbon::today())
            ->latest()
            ->take(5)
            ->get();

        return view('admin.dashboard.index', compact(
            'totalBooking',
            'totalRevenue',
            'totalPortfolio',
            'recentBookings'
        ));
    }
}