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

// Admin Routes Group
Route::prefix('admin')->group(function () {
        Route::get('/', [AdminController::class, 'index'])->name('home');
    Route::get('/payment', [AdminController::class, 'payment'])->name('payment');
    });
