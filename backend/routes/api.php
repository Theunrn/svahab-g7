<?php

use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\API\CategoryController;
use App\Http\Controllers\API\PostController;
use App\Http\Controllers\API\ProductController as APIProductController;
use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('/login', [AuthController::class, 'login']);
Route::get('/me', [AuthController::class, 'index'])->middleware('auth:sanctum');
Route::get('/post/list', [PostController::class, 'index'])->middleware('auth:sanctum');

// Categories API Routes
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/category/list', [CategoryController::class, 'index']);
    Route::post('/category/create', [CategoryController::class, 'store']);
    Route::put('/category/update/{id}', [CategoryController::class, 'update']);
    Route::delete('/category/delete/{id}', [CategoryController::class, 'destroy']);
});

// Products API Routes
Route::get('/product/list', [APIProductController::class, 'index']);
Route::post('/product/create', [APIProductController::class, 'store'])->middleware('auth:sanctum');
Route::put('/product/update/{id}', [APIProductController::class, 'update'])->middleware('auth:sanctum');
Route::delete('/product/delete/{id}', [APIProductController::class, 'destroy'])->middleware('auth:sanctum');
