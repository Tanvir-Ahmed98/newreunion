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
            $name  = $this->registration->name;
            $refId = $this->registration->client_reg_id ?? 'N/A';

            // ✅ Build message (properly quoted)
            $message = "Dear {$name}, your registration for EUSCIANS Reunion 2026 is successful!\n\n"
                     . "Please pay *2000 BDT* via bKash (Merchant: 01879996066) "
                     . "using reference: {$refId} to confirm your registration.\n\n"
                     . "Helpline: 01734442666\nEUSCAA Organizing Committee";

            // ✅ Using sms_net_bd\SMS
            $sms = new SMS();

            // ✅ Send SMS (order: message, recipient)
            $sms->sendSMS($message, $phone);

            \Log::info("✅ SMS sent successfully to {$phone}");

        } catch (\Throwable $e) {
            \Log::error("❌ SMS sending failed for {$this->registration->phone}: {$e->getMessage()}");
        }
    }
}
