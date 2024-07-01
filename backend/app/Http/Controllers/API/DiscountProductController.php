<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\DiscountResource;
use App\Http\Resources\DiscountShowResource;
use App\Models\Discount;
use App\Models\Product; // Import Product model
use Illuminate\Http\Request;

class DiscountProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $discounts = Discount::all();
        $discounts = DiscountResource::collection($discounts);
        return response()->json(['success' => true, 'data' => $discounts], 200);
    }

  
    public function store(Request $request)
    {
        // Custom validation
        $validator = \Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'discount' => 'required|numeric',
            'product_id' => 'required|array',
            'product_id.*' => 'exists:products,id'
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'message' => 'Validation Error'], 400);
        }

        $discount = Discount::store($request); // Assuming store method handles saving discounts

        $discount->products()->sync($request->product_id);

        return response()->json(['success' => true, 'message' => 'Discount created successfully'], 200);
    }


    public function show(string $id)
    {
        $discount = Discount::with('products')->find($id);

        if (!$discount) {
            return response()->json(['success' => false, 'message' => 'Discount not found'], 404);
        }

        return response()->json(['success' => true, 'data' => new DiscountShowResource($discount)], 200);
    }


    public function update(Request $request, $id)
    {
        $validator = \Validator::make($request->all(), [
            'title' => 'sometimes|required|string|max:255',
            'discount' => 'sometimes|required|numeric',
            'product_id' => 'sometimes|required|array',
            'product_id.*' => 'exists:products,id'
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'message' => 'Validation Error'], 400);
        }

        $discount = Discount::store($request, $id);

        if ($request->has('product_id')) {
            $discount->products()->sync($request->product_id);
        } else {
            $discount->products()->detach();
        }

        return response()->json(['success' => true, 'message' => 'Discount updated successfully'], 200);
    }


    public function destroy(string $id)
    {
        $discount = Discount::find($id);
        if (!$discount) {
            return response()->json(['success' => false, 'message' => 'Discount not found'], 404);
        }
        $discount->delete();
        return response()->json(['success' => true, 'message' => "Discount deleted successfully"], 200);
    }
    
}
