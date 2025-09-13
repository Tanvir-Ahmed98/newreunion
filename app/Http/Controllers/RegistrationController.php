<?php

namespace App\Http\Controllers;

use App\Models\Registration;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\Rule;

class RegistrationController extends Controller
{
    public function index()
    {
        return response()->json([
            'data' => Registration::latest()->get()
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'=>'required|string|max:255',
            'email'=>'required|email|unique:registrations',
            'phone'=>'nullable|string|max:20',
            'ssc_batch'=>'nullable|integer',
            'hsc_batch'=>'nullable|integer',
            'guest_above_12'=>'required|integer|min:0',
        ]);

        Registration::create($validated);

        return response()->json([
            'success'=>true,
            'message'=>'Registration saved successfully!'
        ]);
    }
}
