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

    /**
     * Store a newly created resource in storage.
     */
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
            return response()->json(['success' => false, 'message' => 'Product ID Not Found'], 400);
        }

        $discount = Discount::store($request);
        return response()->json(['success' => true, 'message' => "Discount created successfully"], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $discount = Discount::find($id);
        if (!$discount) {
            return response()->json(['success' => false, 'message' => 'Discount not found'], 404);
        }
        $discount = new DiscountShowResource($discount);
        return response()->json(['success' => true, 'data' => $discount], 200);
    }


    public function productsWithDiscount()
    {
        $productsWithDiscount = Product::whereHas('discounts')->with('discounts')->get();

        return response()->json([
            'success' => true,
            'data' => $productsWithDiscount,
        ]);
    }


    public function update(Request $request, string $id)
    {
        // Custom validation
        $validator = \Validator::make($request->all(), [
            'title' => 'sometimes|required|string|max:255',
            'discount' => 'sometimes|required|numeric',
            'product_id' => 'sometimes|required|array',
            'product_id.*' => 'exists:products,id'
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'message' => 'Product ID Not Found'], 400);
        }

        $discount = Discount::store($request, $id);
        return response()->json(['success' => true, 'message' => "Discount updated successfully"], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
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
