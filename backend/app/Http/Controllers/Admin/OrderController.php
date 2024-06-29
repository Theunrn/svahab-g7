<?php

// namespace App\Http\Controllers\Admin;

// use App\Models\Order;
// use App\Http\Resources\OrderProductResource;
// use Illuminate\Http\Request;
// use App\Http\Controllers\Controller;

// class OrderController extends Controller
// {
//     public function index()
//     {
//         $orders = Order::all();
        
//         // Check if $orders is not null
//         if($orders !== null) {
//             $orders = OrderProductResource::collection($orders);
//             return view('setting.order.index', compact('orders'));
//         } else {
//             // Handle the case when there are no orders
//             return response()->json(['status' => false, 'message' => 'No orders found'], 404);
//         }
//     }
// }

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use App\Http\Resources\OrderProductResource;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $date = $request->input('date');
        $status = $request->input('status');
        $ordersQuery = Order::query();

        if ($status === 'cancelled') {
            $ordersQuery->where('status', 'cancelled');
        }

        if ($date) {
            $ordersQuery->whereDate('created_at', $date);
        }

        // Retrieve orders with products and pivot data
        $orders = $ordersQuery->with(['products' => function ($query) {
            $query->withPivot('qty', 'color', 'size');
        }])->get();

        // Check if orders are found
        if ($orders->isNotEmpty()) {
            // Transform orders using resource for consistent JSON response
            $orders = OrderProductResource::collection($orders);
        }
        return view('setting.orders.index', compact('orders'));
    }
}