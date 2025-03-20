<?php

use App\Http\Controllers\v1\Admin\AdminController;
use App\Http\Controllers\v1\Home\HomeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/



Route::get('', [HomeController::class, 'index'])->name('home');

Route::prefix('admin')->group(function () {
    // Admin login route (accessible without authentication)
    Route::get('/login', [AdminController::class, 'loginForm'])->name('login');
    Route::post('/login', [AdminController::class, 'login'])->name('admin.login.submit');

    // Protected admin routes
    Route::middleware(['auth'])->group(function () {
        Route::get('/', [AdminController::class, 'index'])->name('admin.index');
        Route::get('/payment', [AdminController::class, 'payment'])->name('payment');
        Route::get('/logout', [AdminController::class, 'logout'])->name('admin.logout');
    });
});

Route::get('payment-success', [HomeController::class, 'paymentSuccess'])->name('payment.success');
Route::get('payment-failed', [HomeController::class, 'paymentFailed'])->name('payment.failed');
