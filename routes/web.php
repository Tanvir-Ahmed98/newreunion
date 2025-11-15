<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\DashboardController;
Route::view('/', 'welcome');

// === Registration Routes ===
Route::get('/registrations', [RegistrationController::class, 'index'])
    ->name('registrations.index');

Route::post('/registrations', [RegistrationController::class, 'store'])
    ->name('registrations.store');

// === Payment Confirmation Routes ===

// ✅ ইউজার যখন SMS/Email থেকে লিংকে ক্লিক করবে
Route::get('/payment/{token}', [PaymentController::class, 'showPaymentForm'])
    ->name('payment.form');

// ✅ ইউজার তার Transaction ID সাবমিট করলে
Route::post('/payment/{token}', [PaymentController::class, 'submitPayment'])
    ->name('payment.submit');


  Route::get('/login', function () {
    return view('auth.login');
})->name('login');

// Login Submit
Route::post('/login', [\App\Http\Controllers\AuthController::class, 'login'])->name('login.submit');

// Logout
Route::post('/logout', [\App\Http\Controllers\AuthController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard/data', [DashboardController::class, 'data'])->name('dashboard.data');
});
