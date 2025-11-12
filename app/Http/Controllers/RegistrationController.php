<?php

namespace App\Http\Controllers;

use App\Models\Registration;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;
use App\Jobs\SendRegistrationEmailJob;
use App\Jobs\SendRegistrationSmsJob;

class RegistrationController extends Controller
{
    public function store(Request $request): JsonResponse
    {
        DB::beginTransaction();

        try {
            // ✅ Validate input
            $validated = $request->validate([
                'name'               => 'required|string|max:255',
                'email'              => 'required|email|max:255',
                'phone'              => 'required',
                'live_abroad'        => 'required|in:yes,no', // ✅ নতুন validation যোগ করা হয়েছে
                'location'           => 'required|string|max:255',
                'profession'         => 'nullable|string|max:255',
                'blood_group'        => 'nullable|string|max:5',
                'guests_total'       => 'nullable|integer|min:0',
                'guest_above_12'     => 'nullable|integer|min:0',
                'tshirt_size'        => 'nullable|in:S,M,L,XL,XXL,XXXL,4XL',
                'client_reg_id'      => 'required|string|max:50',
                'batch'              => 'nullable|string|max:100',
                'payable_amount'     => 'required|numeric|min:0',
                'photo'              => 'nullable|image|mimes:jpeg,png|max:20480',
                'eusCAA_contribution'=> 'nullable|in:yes,no',
            ]);

            // ✅ Normalize phone number
            $rawPhone = preg_replace('/\D/', '', $validated['phone']);
            if (str_starts_with($rawPhone, '1')) {
                $rawPhone = '0' . $rawPhone; // add leading 0
            }
            $validated['phone'] = $rawPhone;

            // ✅ Cross-field validation
            $total = (int) ($validated['guests_total'] ?? 0);
            $adults = (int) ($validated['guest_above_12'] ?? 0);
            if ($adults > $total) {
                throw ValidationException::withMessages([
                    'guest_above_12' => 'Guests aged 12+ cannot exceed total guests.'
                ]);
            }

            // ✅ Handle photo upload (optional)
            $photoPath = null;
            if ($request->hasFile('photo')) {
                $safeName = preg_replace('/[^A-Za-z0-9_\-]/', '_', $validated['name']);
                $fileName = $safeName . '_' . time() . '.' . $request->file('photo')->getClientOriginalExtension();
                $photoPath = $request->file('photo')->storeAs('reunion-photos', $fileName, 'public');
            }

            // ✅ Save registration (within transaction)
            $registration = Registration::create([
                'name'               => $validated['name'],
                'email'              => $validated['email'],
                'phone'              => $validated['phone'],
                'live_abroad'        => $validated['live_abroad'], // ✅ নতুন ফিল্ড যোগ করা হয়েছে
                'location'           => $validated['location'],
                'profession'         => $validated['profession'] ?? null,
                'blood_group'        => $validated['blood_group'] ?? null,
                'guests_total'       => $validated['guests_total'] ?? 0,
                'guest_above_12'     => $validated['guest_above_12'] ?? 0,
                'tshirt_size'        => $validated['tshirt_size'] ?? null,
                'client_reg_id'      => $validated['client_reg_id'] ?? null,
                'batch'              => $validated['batch'] ?? null,
                'eusCAA_contribution'=> $validated['eusCAA_contribution'] ?? null,
                'payable_amount'     => $validated['payable_amount'],
                'photo_path'         => $photoPath,
                'payment_status'     => 'unpaid',
            ]);

            // ✅ Generate payment link (48 hours)
            $token = bin2hex(random_bytes(16));
            $expiresAt = now()->addHours(48);

            $registration->update([
                'payment_token' => $token,
                'payment_expires_at' => $expiresAt,
            ]);

            $paymentLink = url("/payment/{$token}");

            // ✅ Commit transaction before queuing jobs
            DB::commit();

            // ✅ Prepare SMS number (880XXXXXXXXXX)
            $smsNumber = '880' . substr($validated['phone'], 1);

            // ✅ Dispatch background jobs (outside transaction)
            try {
                dispatch(new SendRegistrationEmailJob($registration, $paymentLink));
                dispatch(new SendRegistrationSmsJob($registration, $paymentLink));
            } catch (\Throwable $e) {
                \Log::error('⚠️ Failed to dispatch email or SMS job: ' . $e->getMessage());
            }

            return response()->json([
                'success' => true,
                'message' => 'Registration successful!',
                'payment_link' => $paymentLink,
            ]);

        } catch (\Throwable $e) {
            DB::rollBack();

            \Log::error('❌ Registration failed: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString(),
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Registration failed. Please try again later.',
                'error'   => $e->getMessage(),
            ], 500);
        }
    }
}