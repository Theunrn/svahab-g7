<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
     /**
     * Display a listing of the products.
     */
    public function index(): JsonResponse
    {
        $products = Product::all();
        return response()->json($products);
    }

    /**
     * Store a newly created product in storage.
     */
    public function store(ProductRequest $request): JsonResponse
    {
        $validatedData = $request->validated();

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

        return response()->json([
            'message' => 'Product created successfully',
            'data' => $product,
        ], 201);
    }

    /**
     * Display the specified product.
     */
    public function show(string $id): JsonResponse
    {
        $product = Product::findOrFail($id);
        return response()->json($product);
    }

    /**
     * Update the specified product in storage.
     */
    public function update(ProductRequest $request, string $id): JsonResponse
    {
        $validatedData = $request->validated();

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

        return response()->json([
            'message' => 'Product updated successfully',
            'data' => $product,
        ]);
    }

    /**
     * Remove the specified product from storage.
     */
    public function destroy(string $id): JsonResponse
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return response()->json([
            'message' => 'Product deleted successfully',
        ], 204);
    }
}
