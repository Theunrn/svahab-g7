<?php

use App\Http\Controllers\Admin\FeedbackController;
use App\Http\Controllers\Admin\FieldController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\API\BookingController;
use App\Http\Controllers\API\OrderProductController;
use App\Http\Controllers\API\PostController;
use App\Http\Controllers\API\ProductController as APIProductController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\OrderController;
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

//Authentication
Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);
Route::put('/customers/{id}/role', [AuthController::class, 'updateRole']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');


Route::get('/me', [AuthController::class, 'index'])->middleware('auth:sanctum');
Route::get('/post/list', [PostController::class, 'index'])->middleware('auth:sanctum');
Route::get('/order/list', [OrderController::class, 'index'])->middleware('auth:sanctum');

Route::get('field/list', [FieldController::class,'index'])->name('field.list');

// product
Route::get('/product/list', [APIProductController::class, 'index']);
Route::post('/product/create', [APIProductController::class, 'create'])->middleware('auth:sanctum');
Route::delete('/product/delete/{id}', [APIProductController::class, 'destroy']);


Route::middleware('auth:sanctum')->group(function () {
    Route::get('orders/list', [OrderProductController::class, 'index']);
    Route::post('orders/create', [OrderProductController::class, 'store']);
    Route::get('orders/show/{id}', [OrderProductController::class, 'show']);
    Route::delete('orders/cancel/{id}', [OrderProductController::class, 'cancel']);
    Route::put('orders/reactivate/{id}', [OrderProductController::class, 'reactivate']);
});


//Booking
Route::get('/booking/list', [BookingController::class, 'index']);
Route::post('/booking/create', [BookingController::class, 'store']);
Route::get('/booking/show/{id}', [BookingController::class, 'show']);
Route::put('/booking/accept/{id}', [BookingController::class, 'acceptBooking']);
Route::put('/booking/reject/{id}', [BookingController::class, 'rejectBooking']);
Route::put('/booking/cancel/{id}', [BookingController::class, 'cancelBooking']);

//feedback
Route::apiResource('feedback',FeedbackController::class);
