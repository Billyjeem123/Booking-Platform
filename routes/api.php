<?php

use App\Http\Controllers\v1\Home\HomeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('payment')->group(function () {
    Route::post('initialize-payment', [HomeController::class, 'initializePayment'])->name('make_payment');
    Route::get('payment-success', [HomeController::class, 'handlePaymentSuccess'])->name('redirect_success');

});
