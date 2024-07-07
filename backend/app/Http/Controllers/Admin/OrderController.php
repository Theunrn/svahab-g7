<?php

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
            $ordersQuery->where('order_status', 'cancelled');
        }

        if ($date) {
            $ordersQuery->whereDate('created_at', $date);
        }

        // Retrieve orders with products, including colors and sizes
        $orders = $ordersQuery->with(['products' => function ($query) {
            $query->withPivot('qty', 'color_id', 'size_id');
        }, 'products.colors', 'products.sizes'])->get();

        // Transform orders using resource for consistent JSON response
        $orders = OrderProductResource::collection($orders);

        return view('setting.orders.index', compact('orders'));
    }
}
