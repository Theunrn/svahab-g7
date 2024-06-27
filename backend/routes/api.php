<?php

use App\Http\Controllers\Admin\FieldController;
use App\Http\Controllers\Api\FildController;
use App\Http\Controllers\API\PostController;
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

Route::get('field/list', [FieldController::class,'index'])->name('field.list');


Route::get('/fields/list', [FildController::class, 'index']);
Route::post('/fields/create', [FildController::class, 'store']);
Route::get('/fields/show/{id}', [FildController::class, 'show']);
Route::put('/fields/update/{id}', [FildController::class, 'update']);
Route::delete('/fields/delete/{id}', [FildController::class, 'destroy']);