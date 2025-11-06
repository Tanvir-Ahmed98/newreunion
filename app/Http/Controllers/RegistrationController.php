<?php

namespace App\Http\Controllers;

use App\Models\Registration;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;
use App\Jobs\SendRegistrationEmailJob;

class RegistrationController extends Controller
{
    public function store(Request $request): JsonResponse
    {
        // ✅ Validate input
        $validated = $request->validate([
            'name'               => 'required|string|max:255',
            'email'              => 'required|email|max:255',
            // 🔽 ফোন অবশ্যই 1 দিয়ে শুরু হবে এবং মোট 10 ডিজিট হবে
            'phone'              => ['required', 'regex:/^1\d{9}$/'],
            'location'           => 'required|string|max:255',
            'profession'         => 'nullable|string|max:255',
            'blood_group'        => 'nullable|string|max:5',
            'guests_total'       => 'nullable|integer|min:0',
            'guest_above_12'     => 'required|integer|min:0',
            'tshirt_size'        => 'nullable|in:S,M,L,XL,XXL',
            'client_reg_id'      => 'required|string|max:50',
            'batch'              => 'nullable|string|max:100',
            'payable_amount'     => 'required|numeric|min:0',
            'photo'              => 'nullable|image|mimes:jpeg,png|max:20480',
            'eusCAA_contribution'=> 'nullable|in:yes,no',
        ]);

        // ✅ Normalize phone number
        // User gives: 1871752332 → Save as 01871752332
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

        // ✅ Save registration
        $registration = Registration::create([
            'name'               => $validated['name'],
            'email'              => $validated['email'],
            'phone'              => $validated['phone'], // saved as 018XXXXXXXX
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
        ]);

        // ✅ Queue the email
        try {
            dispatch(new SendRegistrationEmailJob($registration));
        } catch (\Throwable $e) {
            \Log::error('Failed to dispatch email job: ' . $e->getMessage());
        }

        // ✅ Prepare SMS number (880XXXXXXXXXX)
        // e.g. 01871752332 → 8801871752332
        $smsNumber = '880' . substr($validated['phone'], 1);

        // ✅ Queue the SMS
        try {
            dispatch(new \App\Jobs\SendRegistrationSmsJob($registration, $smsNumber));
        } catch (\Throwable $e) {
            \Log::error('Failed to dispatch SMS job: ' . $e->getMessage());
        }

        return response()->json([
            'success' => true,
            'message' => 'Registration Successful!!!',
        ]);
    }
}
