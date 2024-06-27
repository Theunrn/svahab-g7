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
     * Display a listing of the resource.
     */
    public function index()
    {
       //
    }
    /**
     * Store a newly created resource in storage.
     */
    // Example of storing a product with colors and sizes
    public function create(ProductRequest $request)
    {
        
        if (Auth::check()) {
            Product::store($request);
            return response()->json(['success' => true, 'message' => "Product created succesfully"], 201);
        } else {
            return response()->json(['error' => 'User not stay in login'], 401);
        }
        
    }

    



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product): JsonResponse
    {
        //
    }
}
