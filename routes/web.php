<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DebtController;
use App\Http\Controllers\PaymentController;
use Illuminate\Support\Facades\Route;


Route::middleware('guest')->group(function () {
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);

    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});


Route::middleware('auth')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/debts', [DebtController::class, 'index'])->name('debts');
    Route::post('/debts', [DebtController::class, 'store'])->name('debts.store');
    Route::delete('/debts/{debt}', [DebtController::class, 'destroy'])->name('debts.destroy');

    Route::get('/payments', [PaymentController::class, 'index'])->name('payments');
    Route::post('/payments', [PaymentController::class, 'store'])->name('payments.store');

    Route::get('/profile', fn() => view('pages.users.profile'))->name('profile');

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});
