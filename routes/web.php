<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\PaymentController;

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
