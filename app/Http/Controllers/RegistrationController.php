<?php

namespace App\Http\Controllers;

use App\Models\Registration;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class RegistrationController extends Controller
{
    public function index(): JsonResponse
    {
        // The model appends photo_url
        return response()->json([
            'data' => Registration::latest()->get()
        ]);
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'name'           => ['required','string','max:255'],
            'email'          => ['required','email','max:255','unique:registrations,email'],
            'phone'          => ['required','string','max:50'],

            // new fields from the updated form
            'batch'          => ['required','string','max:255'],
            'location'       => ['required','string','max:255'],
            'profession'     => ['nullable','string','max:255'],
            'guests_total'   => ['nullable','integer','min:0','max:5'], // 5 = 5+
            'guest_above_12' => ['required','integer','min:0'],
            'tshirt_size'    => ['nullable', Rule::in(['S','M','L','XL','XXL'])],
            'donation_bdt'   => ['nullable','integer','min:0'],
            'photo'          => ['nullable','image','mimes:jpeg,png','max:20480'], // 20MB

            // legacy (kept for backward compatibility; UI no longer uses)
            'ssc_batch'      => ['nullable','integer'],
            'hsc_batch'      => ['nullable','integer'],
        ]);

        // Cross-field rule: guests aged 12+ cannot exceed total guests unless total is 5+.
        $total = (int) ($request->input('guests_total', 0)); // 0..5
        $adults = (int) $request->input('guest_above_12', 0);
        if ($total < 5 && $adults > $total) {
            throw ValidationException::withMessages([
                'guest_above_12' => 'Guests aged 12+ cannot exceed total guests.'
            ]);
        }

        // Photo upload (public disk)
        $photoPath = null;
        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('reunion-photos', 'public');
        }

        $registration = Registration::create([
            'name'           => $validated['name'],
            'email'          => $validated['email'],
            'phone'          => $validated['phone'],

            'batch'          => $validated['batch'],
            'location'       => $validated['location'],
            'profession'     => $validated['profession'] ?? null,
            'guests_total'   => $validated['guests_total'] ?? 0,
            'guest_above_12' => $validated['guest_above_12'],
            'tshirt_size'    => $validated['tshirt_size'] ?? null,
            'donation_bdt'   => $validated['donation_bdt'] ?? null,
            'photo_path'     => $photoPath,

            // keep legacy fields if passed (UI won’t send them)
            'ssc_batch'      => $validated['ssc_batch'] ?? null,
            'hsc_batch'      => $validated['hsc_batch'] ?? null,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Registration saved successfully!'
        ]);
    }
}
