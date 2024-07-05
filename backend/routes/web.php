<?php

use App\Http\Controllers\Admin\ProductController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\FieldController;
use App\Http\Controllers\Admin\MailSettingController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\DiscountController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\BookingController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\SlideshowAdminController; // Add this line
use App\Http\Controllers\Admin\UserController;
use Faker\Core\File;
use GuzzleHttp\Psr7\Response;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/test-mail', function () {
    \Mail::raw('Hi, welcome!', function ($message) {
        $message->to('ajayydavex@gmail.com')->subject('Testing mail');
    });
    dd('sent');
});

Route::get('/dashboard', function () {
    return view('front.dashboard');
})->middleware(['front'])->name('dashboard');

require __DIR__ . '/front_auth.php';

// Admin routes
Route::get('/admin/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('admin.dashboard');

require __DIR__ . '/auth.php';
Route::get('/storage/{filename}', function ($filename) {
    $path = storage_path('app/public/' . $filename);
    if (!File::exists($path)) {
        abort(404);
    }
    $file = File::get($path);
    $type = File::mimeType($path);
    $response = Response::make($file, 200);
    $response->header("Content-Type", $type);
    return $response;
})->where('filename', '.*');

// routes/web.php

Route::get('/dropdown', function () {
    return view('dropdown');
});


Route::namespace('App\Http\Controllers\Admin')->name('admin.')->prefix('admin')
    ->group(function () {
        Route::put('orders/{id}/reactivate', [OrderController::class, 'reactivate'])
            ->name('orders.reactivate');

        Route::resource('roles', 'RoleController');
        Route::resource('permissions', 'PermissionController');
        Route::resource('users', 'UserController');
        Route::resource('posts', 'PostController');
        Route::resource('fields', 'FieldController');
        Route::resource('bookings', 'BookingController');
        Route::resource('settings', 'SettingController');
        Route::resource('slideshow', 'SlideShowController'); // Update this line
        Route::resource('products', 'ProductController');
        Route::resource('categories', 'CategoryController');
        Route::resource('payments', 'PaymentController');
        Route::resource('feedbacks', 'FeedbackController');
        Route::resource('orders', 'OrderController');
        Route::resource('discounts', 'DiscountController');

        Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
        Route::put('/profile-update', [ProfileController::class, 'update'])->name('profile.update');
        Route::get('/mail', [MailSettingController::class, 'index'])->name('mail.index');
        Route::put('/mail-update/{mailsetting}', [MailSettingController::class, 'update'])->name('mail.update');
    });
Route::get('/admin/bookings/{id}/cancel', [BookingController::class, 'cancel'])->name('admin.bookings.cancel');
Route::get('/admin/bookings/{id}/rebook', [BookingController::class, 'reStore'])->name('admin.bookings.rebook');
Route::get('/admin/bookings/{id}/accept', [BookingController::class, 'accept'])->name('admin.bookings.accept');
Route::get('/admin/bookings/{id}/reject', [BookingController::class, 'reject'])->name('admin.bookings.reject');
Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');


Route::resource('dashboards', DashboardController::class);



Route::prefix('admin')->middleware(['auth'])->group(function () {
    // Other admin routes...

    Route::resource('dashboards', DashboardController::class);
});
