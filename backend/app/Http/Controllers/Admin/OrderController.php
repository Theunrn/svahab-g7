<?php
namespace App\Http\Controllers\Admin;

use App\Models\Order;
use App\Http\Resources\OrderProductResource;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Notification;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $date = $request->input('date');
        $status = $request->input('status');
        $ordersQuery = Order::query();

        // if ($status === 'cancelled') {
        //     $ordersQuery->where('order_status', 'cancelled');
        // }

        if ($date) {
            $ordersQuery->whereDate('created_at', $date);
        }

        // Include user relationship to retrieve user's name
        $orders = $ordersQuery->with(['user', 'products' => function ($query) {
            $query->withPivot('qty', 'color_id', 'size_id');
        }, 'products.colors', 'products.sizes'])->get();

        // Check if orders are found
        if ($orders->isNotEmpty()) {
            // Transform orders using resource for consistent JSON response
            $orders = OrderProductResource::collection($orders);
        }
        $orders= Order::latest()->get();
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
}



