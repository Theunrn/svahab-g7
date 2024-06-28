<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
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

        // Retrieve orders for the authenticated user
        $orders = Order::where('user_id', $user->id)->with('products')->get();

        return response()->json(['orders' => $orders], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate incoming request
        $validatedData = $request->validate([
            'product_id' => 'nullable|exists:products,id',
            'qty' => 'required|integer|min:1',
        ]);

        try {
            // Get authenticated user (customer)
            $user = Auth::user();

            // Create a new order instance
            $order = new Order();
            $order->user_id = $user->id;
            $order->save();

            // Attach the product to the order with quantity
            $product = Product::findOrFail($validatedData['product_id']);
            $order->products()->attach($product->id, ['qty' => $validatedData['qty']]);

            return response()->json(['message' => 'Order created successfully', 'order' => $order], 201);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to create order', 'error' => $e->getMessage()], 500);
        }
    }

    public function show($id)
    {
        // Get authenticated user (customer)
        $user = Auth::user();

        // Find the order with products for the authenticated user
        $order = Order::where('user_id', $user->id)->with('products')->findOrFail($id);

        return response()->json(['order' => $order], 200);
    }


    public function cancel($id)
    {
        try {
            // Get authenticated user (customer)
            $user = Auth::user();

            // Find the order and delete it for the authenticated user
            $order = Order::where('user_id', $user->id)->findOrFail($id);

            // Check if the order is not already cancelled
            if ($order->status !== 'cancelled') {
                // Update the order status to 'cancelled'
                $order->status = 'cancelled';
                $order->save();

                return response()->json(['message' => 'Order cancelled successfully'], 200);
            } else {
                return response()->json(['message' => 'Order is already cancelled'], 400);
            }
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to cancel order', 'error' => $e->getMessage()], 500);
        }
    }


    public function reactivate($id)
    {
        try {
            // Find the order by ID
            $order = Order::findOrFail($id);

            // Check if the order is cancelled
            if ($order->status === 'cancelled') {
                // Update order status to 'active'
                $order->status = 'active';
                $order->save();

                return response()->json(['message' => 'Order reactivated successfully', 'order' => $order], 200);
            } else {
                return response()->json(['message' => 'Order is not cancelled, cannot reactivate'], 400);
            }
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to reactivate order', 'error' => $e->getMessage()], 500);
        }
    }

}
