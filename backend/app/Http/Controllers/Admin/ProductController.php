<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all();
        return view('setting.products.index', compact('products'));
    }
    


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('setting.products.new');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'image' => 'nullable|image|max:2048', // Max 2MB and must be an image file
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'color' => 'nullable|array', // Should be an array
            'size' => 'nullable|array',  // Should be an array
        ]);

        // Handle image upload if provided
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('product_images', 'public');
            $validatedData['image'] = $imagePath;
        }

        // Create new product
        $product = Product::create($validatedData);

        return redirect()->route('admin.products.index')->with('success', 'Product created successfully!');
    }


    public function edit(string $id)
    {
        $product = Product::findOrFail($id);
        return view('setting.products.edit', compact('product'));
    }

    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        // Update basic attributes
        $product->name = $request->input('name');
        $product->description = $request->input('description');
        $product->price = $request->input('price');

        // Update color and size attributes
        $product->color = $request->input('color', []);
        $product->size = $request->input('size', []);

        // Handle image upload if needed
        if ($request->hasFile('image')) {
            // Handle image upload logic here
            // Example:
            // $imagePath = $request->file('image')->store('products', 'public');
            // $product->image = $imagePath;
        }

        // Save the updated product
        $product->save();

        return redirect()->route('admin.products.index')->with('success', 'Product updated successfully.');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return redirect()->route('admin.products.index')->with('success', 'Product deleted successfully.');
    }
}
