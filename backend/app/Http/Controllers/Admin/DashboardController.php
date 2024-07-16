<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;
use App\Http\Controllers\BookingController;
use App\Models\Feedback;
use App\Models\Field;
use App\Models\Payment;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $totalBookings = Booking::count(); // Replace with your logic to fetch total bookings
        $totalUsers = User::count();
        $totalFiels = Field::count();
        $totalFeedbacks = Feedback::count();
        $totalPayments = Payment::count();
        $payments = Payment::with('customer')->get();
        $totalAmount = $payments->sum('amount');

        return view('dashboard', compact('totalBookings', 'totalUsers', 'totalFiels', 'totalFeedbacks', 'totalPayments', 'payments', 'totalAmount'));

    }
    
}
