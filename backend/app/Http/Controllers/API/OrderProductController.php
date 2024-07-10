<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\OrderProductResource;
use App\Models\Notification;
use App\Models\Order;
use App\Models\product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Get authenticated user (customer)
        $user = Auth::user();

        $orders = Order::where('user_id', $user->id)->with('products')->get();

        $orders->each(function ($order) {
            $order->total_amount = $order->total_amount; // This line is redundant if total_amount is already an attribute
        });
        $orders = OrderProductResource::collection($orders);
        return response()->json(['success' => true, 'data' => $orders], 200);
    }


    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'product_id' => 'required|exists:products,id',
            'qty' => 'required|integer|min:1',
            'color_id' => 'nullable|exists:colors,id',
            'size_id' => 'nullable|exists:sizes,id',
            'total_amount' => 'nullable',
        ]);

        $order = Order::createOrder($validatedData);

        return response()->json(['message' => 'Order created successfully', 'order' => $order], 201);
    }
   
    public function show($id)
    {
        // Get authenticated user (customer)
        // $user = Auth::user();

        // Find the order with products for the authenticated user
        $order = Order::with('products')->findOrFail($id);

        return response()->json(['success' => true, 'data' => $order], 200);
    }


    public function cancel($id)
    { {
            $user = Auth::user();
            $order = Order::where('user_id', $user->id)->findOrFail($id);

            $order->status = 'cancelled';
            $order->save();

            // Create a notification for order cancellation
            Notification::create([
                'user_id' => $user->id,
                'notification_type' => 'order_cancelled',
                'notification_text' => 'Your order has been cancelled.',
                'notification_data' => json_encode([
                    'order_id' => $order->id,
                    'cancelled_at' => now(),
                ]),
                'read' => false,
            ]);

            return response()->json(['message' => 'Order cancelled successfully'], 200);
        }
    }
    public function confirm(Request $request, $id)
    {
        $user = Auth::user();
        $order = Order::findOrFail($id);

        // Confirm the order
        $order->confirmOrder();

        // Create a notification for order confirmation
        Notification::create([
            'user_id' => $order->user_id,
            'notification_type' => 'order_confirmed',
            'notification_text' => 'Your order has been confirmed.',
            'notification_data' => json_encode([
                'order_id' => $order->id,
                'confirmed_at' => now(),
            ]),
            'read' => false,
        ]);

        return response()->json(['message' => 'Order confirmed successfully'], 200);
    }



    public function reactivate($id)
    {
        $order = Order::findOrFail($id);

        if ($order->reactivate()) {
            return response()->json(['message' => 'Order reactivated successfully', 'order' => $order], 200);
        } else {
            return response()->json(['message' => 'Order is not cancelled, cannot reactivate'], 400);
        }
    }
    // app/Http/Controllers/OrderController.php
    public function getOrdersByUserId($id)
    {
        $orders = Order::where('user_id', $id)->get();
        $orders = OrderProductResource::collection($orders);
        if ($orders->isEmpty()) {
            return response()->json(['error' => 'No orders found for this user'], 404);
        }
        return response()->json($orders, 200);
    }

    public function deleteOrder($id)
    {
        $order = Order::findOrFail($id);
        $order->delete();
        return response()->json(['message' => 'Order deleted successfully'], 200);
    }
    public function updateStatusPaymentOrder($id){
        $order = Order::findOrFail($id);
        $order->payment_status = 'paid';
        $order->save();
        return response()->json(['message' => 'Payment status updated successfully'], 200);
    }
}
