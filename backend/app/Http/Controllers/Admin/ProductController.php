<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
{
    $categories = Category::all(); // Fetch all categories for the dropdown

    $productsQuery = Product::query();

    // Check if category filter is applied
    if ($request->has('category') && $request->category != '') {
        $category_id = $request->category;

        // If category ID is provided and not empty, filter by category
        if (!empty($category_id)) {
            $productsQuery->where('category_id', $category_id);
        }
    }

    $products = $productsQuery->get();

    return view('setting.products.index', compact('products', 'categories'));
}
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('setting.products.new', compact('categories'));
    }

    public function store(Request $request)
    {
        // Validate incoming request
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // adjust max file size if needed
            'category_id' => 'required|exists:categories,id', // ensure category exists in database
            'color' => 'nullable|array', // optional, if colors are required
            'size' => 'nullable|array', // optional, if sizes are required
        ]);

        // Handle file upload (image)
        $imageName = time() . '.' . $request->image->extension();
        $request->image->storeAs('public/images', $imageName);

        // Create new product
        $product = new Product();
        $product->name = $validatedData['name'];
        $product->description = $validatedData['description'];
        $product->price = $validatedData['price'];
        $product->image = 'images/' . $imageName; // assuming storage symlink is set up
        $product->category_id = $validatedData['category_id'];
        // Add colors if provided
        if (isset($validatedData['color'])) {
            $product->color = $validatedData['color'];
        }
        // Add sizes if provided
        if (isset($validatedData['size'])) {
            $product->size = $validatedData['size'];
        }
        $product->save();

        // Redirect to a success page or back to the form with a success message
        return redirect()->route('admin.products.index')->with('success', 'Product created successfully.');
    }


    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('setting.products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, $id)
    {
        // Validate incoming request
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // adjust max file size if needed
            'category_id' => 'required|exists:categories,id', // ensure category exists in database
            'color' => 'nullable|array', // optional, if colors are required
            'size' => 'nullable|array', // optional, if sizes are required
        ]);

        // Find the product
        $product = Product::findOrFail($id);

        // Handle file upload (image) if provided
        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->storeAs('public/images', $imageName);
            $product->image = 'images/' . $imageName; // assuming storage symlink is set up
        }

        // Update product details
        $product->name = $validatedData['name'];
        $product->description = $validatedData['description'];
        $product->price = $validatedData['price'];
        $product->category_id = $validatedData['category_id'];
        // Update colors if provided
        if (isset($validatedData['color'])) {
            $product->color = $validatedData['color'];
        }
        // Update sizes if provided
        if (isset($validatedData['size'])) {
            $product->size = $validatedData['size'];
        }

        // Save the updated product
        $product->save();

        // Redirect back with success message
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
