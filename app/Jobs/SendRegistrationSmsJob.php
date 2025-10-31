<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use sms_net_bd\SMS;
use App\Models\Registration;

class SendRegistrationSmsJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $registration;

    /**
     * Create a new job instance.
     */
    public function __construct(Registration $registration)
    {
        $this->registration = $registration;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        try {
            $phone = $this->registration->phone;
            $name = $this->registration->name;

            $message = "Dear {$name}, your registration for the Reunion event is successful! 🎉 Thank you for joining.";

            // ✅ Using sms_net_bd\SMS
            $sms = new SMS();
            $sms->sendSMS($phone, $message);

        } catch (\Throwable $e) {
            \Log::error("SMS sending failed for registration ID {$this->registration->id}: {$e->getMessage()}");
        }
    }
}
