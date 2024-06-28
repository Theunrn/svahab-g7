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
use Carbon\Carbon;

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
            $orders = Order::whereDate('created_at', $date)->get();
        } else {
            $orders = Order::all();
        }

        if($orders !== null) {
            $orders = OrderProductResource::collection($orders);
            return view('setting.orders.index', compact('orders'));
        } else {
            return response()->json(['status' => false, 'message' => 'No orders found'], 404);
        }
    }
}
