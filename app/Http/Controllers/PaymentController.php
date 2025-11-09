<?php

namespace App\Http\Controllers;

use App\Models\Registration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PaymentController extends Controller
{
    /**
     * Show the payment confirmation form.
     */
    public function showPaymentForm(string $token)
    {
        $registration = Registration::where('payment_token', $token)->first();

        if (!$registration) {
            return response()->view('payment.invalid', [
                'message' => 'Invalid or expired payment link.'
            ], 404);
        }

        // Check expiry
        if (now()->greaterThan($registration->payment_expires_at)) {
            if ($registration->payment_status !== 'paid') {
                $registration->delete(); // soft delete
            }

            return response()->view('payment.invalid', [
                'message' => 'Your payment link has expired. Please register again.'
            ], 410);
        }

        // Already paid
        if ($registration->payment_status === 'paid') {
            return view('payment.already-paid', compact('registration'));
        }

        return view('payment.form', compact('registration'));
    }

    /**
     * Handle the payment confirmation submission.
     */
    public function submitPayment(Request $request, string $token)
    {
        $registration = Registration::where('payment_token', $token)->first();

        if (!$registration) {
            return response()->view('payment.invalid', [
                'message' => 'Invalid or expired payment link.'
            ], 404);
        }

        if (now()->greaterThan($registration->payment_expires_at)) {
            return response()->view('payment.invalid', [
                'message' => 'Your payment link has expired. Please register again.'
            ], 410);
        }

        $validated = $request->validate([
            'transaction_id' => 'required|string|max:100',
        ]);

        DB::transaction(function () use ($registration, $validated) {
            $registration->update([
                'transaction_id'       => $validated['transaction_id'],
                'payment_status'       => 'paid',
                'payment_confirmed_at' => now(),
            ]);
        });

        return view('payment.success', compact('registration'));
    }
}
