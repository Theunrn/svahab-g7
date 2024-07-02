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
        $products = Product::all(); // Adjust this as per your product retrieval logic
        return view('setting.discounts.create', compact('products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'product_id' => 'required|array',
            'product_id.*' => 'exists:products,id',
            'discount' => 'required|numeric|min:0|max:100',
        ]);

        $discount = Discount::create([
            'title' => $request->title,
            'discount' => $request->discount,
        ]);

        $discount->products()->attach($request->product_id);

        return redirect()->route('admin.discounts.index')->with('success', 'Discount created successfully.');
    }

    public function edit(Discount $discount)
    {
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

        $discount->update([
            'title' => $request->title,
            'discount' => $request->discount,
        ]);

        $discount->products()->sync($request->product_id);

        return redirect()->route('admin.discounts.index')->with('success', 'Discount updated successfully.');
    }

    public function destroy(Discount $discount)
    {
        $discount->products()->detach();
        $discount->delete();

        return redirect()->route('admin.discounts.index')->with('success', 'Discount deleted successfully.');
    }
}
