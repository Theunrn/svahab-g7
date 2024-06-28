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


    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'product_id' => 'nullable|exists:products,id',
            'qty' => 'required|integer|min:1',
            'color' => 'nullable|string|max:255',
            'size' => 'nullable|string|in:S,M,L,XL,XXL,1XL,2XL,3XL',
        ]);

        $order = Order::createOrder($validatedData);

        return response()->json(['message' => 'Order created successfully', 'order' => $order], 201);
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
        $user = Auth::user();
        $order = Order::where('user_id', $user->id)->findOrFail($id);

        $response = $order->cancelOrder();

        return response()->json($response, $response['message'] === 'Order cancelled successfully' ? 200 : 400);
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
    
}
