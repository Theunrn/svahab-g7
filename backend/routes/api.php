<?php

use App\Http\Controllers\Admin\FieldController;
<<<<<<< HEAD
use App\Http\Controllers\Api\FildController;
=======
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Api\FeedbackController;
>>>>>>> af9eff645019aaf4d6fe8a6959c5ebf3020f0ede
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

<<<<<<< HEAD

Route::get('/fields/list', [FildController::class, 'index']);
Route::post('/fields/create', [FildController::class, 'store']);
Route::get('/fields/show/{id}', [FildController::class, 'show']);
Route::put('/fields/update/{id}', [FildController::class, 'update']);
Route::delete('/fields/delete/{id}', [FildController::class, 'destroy']);
=======
// product
Route::get('/product/list', [APIProductController::class, 'index']);
Route::post('/product/create', [APIProductController::class, 'create'])->middleware('auth:sanctum');
Route::delete('/product/delete/{id}', [APIProductController::class, 'destroy']);


//feedback
Route::apiResource('feedback',FeedbackController::class);
>>>>>>> af9eff645019aaf4d6fe8a6959c5ebf3020f0ede
