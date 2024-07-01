<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Discount;
use App\Models\Product;
use App\Http\Controllers\Controller;

class DiscountController extends Controller
{
    public function index()
    {
        $discounts = Discount::with('products')->get();
        return view('setting.discounts.index', compact('discounts'));
    }

    public function create()
    {
        // Assuming you want to fetch products for selection in your create form
        $products = Product::all(); // Adjust this as per your product retrieval logic
        return view('setting.discounts.create', compact('products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'product_id' => 'required|array',
            'product_id.*' => 'exists:products,id', // Validate each product_id exists in products table
            'discount' => 'required|numeric|min:0|max:100', // Assuming discount is a percentage
        ]);

        // Create the discount
        $discount = Discount::create([
            'title' => $request->title,
            'discount' => $request->discount,
        ]);

        // Attach products to the discount
        $discount->products()->attach($request->product_id);

        return redirect()->route('setting.discounts.index')->with('success', 'Discount created successfully.');
    }

    public function edit(Discount $discount)
    {
        // Fetch products for selection in edit form
        $products = Product::all(); // Adjust as per your needs
        return view('setting.discounts.edit', compact('discount', 'products'));
    }

    public function update(Request $request, Discount $discount)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'product_id' => 'required|array',
            'product_id.*' => 'exists:products,id',
            'discount' => 'required|numeric|min:0|max:100',
        ]);

        // Update the discount
        $discount->update([
            'title' => $request->title,
            'discount' => $request->discount,
        ]);

        // Sync products for the discount
        $discount->products()->sync($request->product_id);

        return redirect()->route('setting.discounts.index')->with('success', 'Discount updated successfully.');
    }

    public function destroy(Discount $discount)
    {
        // Detach all products related to the discount before deleting
        $discount->products()->detach();

        // Delete the discount
        $discount->delete();

        return redirect()->route('setting.discounts.index')->with('success', 'Discount deleted successfully.');
    }
}
