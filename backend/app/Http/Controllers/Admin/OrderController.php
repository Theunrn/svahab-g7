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

<<<<<<< HEAD
=======
        if ($status === 'cancelled') {
            $ordersQuery->where('order_status', 'cancelled');
        }

>>>>>>> 9214fc5f8789ec0c2cb9ef34d754ec70dad63bd5
        if ($date) {
            $ordersQuery->whereDate('created_at', $date);
        }

<<<<<<< HEAD
        $orders = $ordersQuery->with(['user', 'products' => function ($query) {
            $query->withPivot('qty', 'color_id', 'size_id');
        }, 'products.colors', 'products.sizes'])->get();

        if ($orders->isNotEmpty()) {
            $orders = OrderProductResource::collection($orders);
        }

        return view('setting.orders.index', compact('orders'));
    }

    public function cancel($id)
    {
        $order = Order::find($id);

        if (!$order) {
            return response()->json(['status' => false, 'message' => 'Order not found'], 404);
        }

        $order->order_status = 'cancelled';
        $order->save();
        $this->createNotification($order->user_id, 'order_cancelled', 'Your order has been cancelled.', $order->id);

        return redirect()->route('admin.orders.index')->with('success', 'Booking cancelled successfully');
    }

    public function confirm($id)
    {
        $order = Order::find($id);

        if (!$order) {
            return response()->json(['status' => false, 'message' => 'Order not found'], 404);
        }

        $order->order_status = 'confirmed';
        $order->save();
        $this->createNotification($order->user_id, 'order_confirmed', 'Your order has been confirmed.', $order->id);

        return redirect()->route('admin.orders.index')->with('success', 'Booking confirmed successfully');
    }

    private function createNotification($userId, $type, $text, $orderId)
    {
        $notification = new Notification();
        $notification->user_id = $userId;
        $notification->notification_type = $type;
        $notification->notification_text = $text;
        $notification->notification_data = json_encode(['order_id' => $orderId]);
        $notification->read = false;
        $notification->save();
    }
=======
        // Retrieve orders with products, including colors and sizes
        $orders = $ordersQuery->with(['products' => function ($query) {
            $query->withPivot('qty', 'color_id', 'size_id');
        }, 'products.colors', 'products.sizes'])->get();

        // Transform orders using resource for consistent JSON response
        $orders = OrderProductResource::collection($orders);

        return view('setting.orders.index', compact('orders'));
    }
>>>>>>> 9214fc5f8789ec0c2cb9ef34d754ec70dad63bd5
}
