<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
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
        $totalBookings = Booking::count();
        $totalUsers = User::count();
        $totalFiels = Field::count();
        $totalFeedbacks = Feedback::count();
        $totalPayments = Payment::sum('amount'); // Total amount of all payments
        $payments = Payment::with('customer')->get();
        $totalAmount = $payments->sum('amount');
        $daysOfWeek = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
        $weeklyPayment = [];
        $weeklyDataField = [];

        foreach ($daysOfWeek as $day) {
            $totalAmount = Payment::whereDate('created_at', Carbon::parse('this week ' . $day)->format('Y-m-d'))
                ->sum('amount');

            $weeklyPayment[] = $totalAmount > 0 ? $totalAmount : 0; // Store total amount for each day
        }

        $totalWeekAmount = array_sum($weeklyPayment); // Total sum for the week

        foreach ($daysOfWeek as $day) {
            $totalBookingField = Booking::whereDate('created_at', Carbon::parse('this week ' . $day)->format('Y-m-d'))
                ->count();

            $weeklyDataField[] = $totalBookingField; // Store total bookings for each day
        }

        $totalWeekBookings = array_sum($weeklyDataField); // Total sum for the week

        // Get top 5 product orders with orders and calculate percentages
        $productOrders = Product::withCount('orders')
            ->having('orders_count', '>', 0)
            ->orderBy('orders_count', 'desc')
            ->take(5)
            ->get();

        $totalOrders = Order::count();

        $productData = $productOrders->map(function ($product) use ($totalOrders) {
            return [
                'name' => $product->name,
                'percentage' => ($product->orders_count / $totalOrders) * 100,
            ];
        });

        return view('dashboard', compact('totalBookings', 'totalUsers', 'totalFiels', 'totalFeedbacks', 'totalPayments', 'weeklyPayment', 'weeklyDataField', 'totalWeekAmount', 'totalWeekBookings', 'productData', 'totalOrders'));
        

    }

}
