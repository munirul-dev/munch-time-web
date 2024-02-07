<?php

use App\Http\Controllers\PaymentController;
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

Route::get('/', function () {
    abort(403);
});

Route::prefix('payment')->name('payment.')->group(function () {
    Route::get('process', [PaymentController::class, 'process'])->name('process');
    Route::get('return', [PaymentController::class, 'return'])->name('return');
    Route::post('callback', [PaymentController::class, 'return'])->name('callback');
});
