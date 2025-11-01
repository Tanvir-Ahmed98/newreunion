<?php

namespace App\Jobs;

use App\Models\Registration;
use App\Mail\RegistrationReceipt;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Mail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendRegistrationEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public Registration $registration;

    public function __construct(Registration $registration)
    {
        // Store only the model ID if you prefer lighter payloads:
        // $this->registrationId = $registration->getKey();
        $this->registration = $registration;
    }

    public function handle(): void
    {
        // If you stored only ID, re-fetch: $registration = Registration::find($this->registrationId);
        Mail::to($this->registration->email)
            ->send(new RegistrationReceipt($this->registration));
    }
}
