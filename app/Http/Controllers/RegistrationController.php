<?php

namespace App\Http\Controllers;

use App\Models\Registration;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;
use App\Jobs\SendRegistrationEmailJob;
use App\Jobs\SendRegistrationSmsJob;

class RegistrationController extends Controller
{
    public function store(Request $request): JsonResponse
    {
        // ✅ Validate input
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:30',
            'location' => 'required|string|max:255',
            'profession' => 'nullable|string|max:255',
            'guests_total' => 'nullable|integer|min:0',
            'guest_above_12' => 'required|integer|min:0',
            'tshirt_size' => 'nullable|in:S,M,L,XL,XXL',
            'client_reg_id' => 'required|string|max:50',
            'batch' => 'nullable|string|max:100',
            'payable_amount' => 'required|numeric|min:0',
            'photo' => 'nullable|image|mimes:jpeg,png|max:20480',
        ]);

        // ✅ Cross-field validation
        $total = (int) ($validated['guests_total'] ?? 0);
        $adults = (int) ($validated['guest_above_12'] ?? 0);
        if ($adults > $total) {
            throw ValidationException::withMessages([
                'guest_above_12' => 'Guests aged 12+ cannot exceed total guests.'
            ]);
        }

        // ✅ Handle photo upload
        $photoPath = null;
        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('reunion-photos', 'public');
        }

        // ✅ Save registration
        $registration = Registration::create([
            'name'            => $validated['name'],
            'email'           => $validated['email'],
            'phone'           => $validated['phone'],
            'location'        => $validated['location'],
            'profession'      => $validated['profession'] ?? null,
            'guests_total'    => $validated['guests_total'] ?? 0,
            'guest_above_12'  => $validated['guest_above_12'] ?? 0,
            'tshirt_size'     => $validated['tshirt_size'] ?? null,
            'client_reg_id'   => $validated['client_reg_id'] ?? null,
            'batch'           => $validated['batch'] ?? null,
            'payable_amount'  => $validated['payable_amount'],
            'photo_path'      => $photoPath,
        ]);

        // ✅ Queue the email (background)
        try {
            dispatch(new SendRegistrationEmailJob($registration));
            // or: SendRegistrationEmailJob::dispatch($registration);
        } catch (\Throwable $e) {
            \Log::error('Failed to dispatch email job: ' . $e->getMessage());
        }

        // ✅ Queue the SMS (background) - optional but recommended
        try {
            dispatch(new SendRegistrationSmsJob($registration));
        } catch (\Throwable $e) {
            \Log::error('Failed to dispatch SMS job: ' . $e->getMessage());
        }

        return response()->json([
            'success'   => true,
            'message'   => 'Registration saved! Email & SMS queued.',
            // 'unique_id' => $registration->unique_id_candidate ?? $registration->id,
        ]);
    }
}
