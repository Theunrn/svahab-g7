<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;
use App\Http\Controllers\BookingController;
use App\Models\Feedback;
use App\Models\Field;
use App\Models\Order;
use App\Models\Payment;
use App\Models\Product;
use App\Models\User;
use Carbon\Carbon;

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

        $daysOfWeek = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
        $weeklyPayment = [];
        $weeklyDataField = [];

        foreach ($daysOfWeek as $day) {
            $totalAmount = Payment::whereDate('created_at', Carbon::parse('this ' . $day)->format('Y-m-d'))
                ->sum('amount');

            $weeklyPayment[$day] = $totalAmount; // Store total amount for each day
        }

        $totalWeekAmount = array_sum($weeklyPayment); // Total sum for the week


        foreach ($daysOfWeek as $day) {
            $totalBookingField = Booking::whereDate('created_at', Carbon::parse('this ' . $day)->format('Y-m-d'))
                ->count();
    
            $weeklyDataField[$day] = $totalBookingField; // Store total bookings for each day
        }
    
        $totalWeekBookings = array_sum($weeklyDataField); // Total sum for the week
        // dd($totalWeekBookings);

        // Get product orders and calculate percentages
        $productOrders = Product::withCount('orders')
            ->orderBy('orders_count', 'desc')
            ->take(5)
            ->get();
        $totalOrders = Order::count();

        $productData = $productOrders->map(function($product) use ($totalOrders) {
            return [
                'name' => $product->name,
                'percentage' => ($product->orders_count / $totalOrders) * 100
            ];
        });

        return view('dashboard', compact('totalBookings', 'totalUsers', 'totalFiels', 'totalFeedbacks', 'totalPayments', 'weeklyPayment', 'weeklyDataField', 'totalWeekAmount', 'totalWeekBookings', 'productData'));
    }
    
}

