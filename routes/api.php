<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\SettlementController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\UserController;
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

Route::prefix('auth')->name('auth.')->group(function () {
    Route::post('login', [AuthController::class, 'login']);
    Route::post('forgot', [AuthController::class, 'forgot']); // TODO
    Route::post('reset', [AuthController::class, 'reset']); // TODO
    Route::post('register', [AuthController::class, 'register']);
});

Route::middleware(['auth:sanctum'])->prefix('auth')->name('auth.')->group(function () {
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('validate', [AuthController::class, 'validator']);
    Route::post('updateProfile', [UserController::class, 'updateProfile']);
});

Route::middleware(['auth:sanctum'])->prefix('user')->name('user.')->group(function () {
    Route::post('index', [UserController::class, 'index']);
    Route::post('create', [UserController::class, 'create']);
    Route::post('edit', [UserController::class, 'edit']);
    Route::post('update', [UserController::class, 'update']);
    Route::post('destroy', [UserController::class, 'destroy']);
});

Route::middleware(['auth:sanctum'])->prefix('student')->name('student.')->group(function () {
    Route::post('index', [StudentController::class, 'index']);
    Route::post('create', [StudentController::class, 'create']);
    Route::post('edit', [StudentController::class, 'edit']);
    Route::post('update', [StudentController::class, 'update']);
    Route::post('destroy', [StudentController::class, 'destroy']);
});

Route::middleware(['auth:sanctum'])->prefix('menu')->name('menu.')->group(function () {
    Route::post('index', [MenuController::class, 'index']);
    Route::post('create', [MenuController::class, 'create']);
    Route::post('edit', [MenuController::class, 'edit']);
    Route::post('update', [MenuController::class, 'update']);
    Route::post('destroy', [MenuController::class, 'destroy']);
});

Route::middleware(['auth:sanctum'])->prefix('reservation')->name('reservation.')->group(function () {
    Route::post('index', [ReservationController::class, 'index']);
    Route::post('create', [ReservationController::class, 'create']);
    Route::post('edit', [ReservationController::class, 'edit']);
    Route::post('destroy', [ReservationController::class, 'destroy']);
    Route::post('scanQR', [ReservationController::class, 'scanQR']);
    Route::post('redeem', [ReservationController::class, 'redeem']);
});

Route::middleware(['auth:sanctum'])->prefix('payment')->name('payment.')->group(function () {
    Route::post('index', [PaymentController::class, 'index']);
    Route::post('makePayment', [PaymentController::class, 'makePayment']);
    Route::post('fetchPaymentStatus', [PaymentController::class, 'fetchPaymentStatus']);
});

Route::middleware(['auth:sanctum'])->prefix('settlement')->name('settlement.')->group(function () {
    Route::post('index', [SettlementController::class, 'index']);
    Route::post('makeWithdrawal', [SettlementController::class, 'makeWithdrawal']);
    Route::post('processWithdrawal', [SettlementController::class, 'processWithdrawal']);
});
