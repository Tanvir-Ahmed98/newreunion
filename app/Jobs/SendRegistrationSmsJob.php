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
    protected $paymentLink;

    /**
     * Create a new job instance.
     */
    public function __construct(Registration $registration, string $paymentLink)
    {
        $this->registration = $registration;
        $this->paymentLink = $paymentLink;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        try {
            $phone   = $this->registration->phone;
            $name    = $this->registration->name;
            $refId   = $this->registration->client_reg_id ?? 'N/A';
            $amount  = number_format((float) $this->registration->payable_amount, 2);
            $link    = $this->paymentLink;

            // ✅ Fixed Template with dynamic data
            $message = "Dear {$name} Your EUSCIANS Reunion 2026 form is submitted.\n"
                     . "Please pay {$amount} via bKash (Merchant Account): +8801879996066 (EUSCAA) using \n"
                     . "Ref ID: {$refId} within 48 hrs to confirm.\n"
                     . "Unpaid forms will be cancelled.\n"
                     . "Use this link to send us your transaction ID to confirm.\n"
                     . "{$link}\n"
                     . "Helpline: 01410969009 (whatsapp)";

            // ✅ Send SMS via sms_net_bd\SMS
            $sms = new SMS();
            $sms->sendSMS($message, $phone);

            \Log::info("✅ Registration SMS sent successfully to {$phone}");

        } catch (\Throwable $e) {
            \Log::error("❌ SMS sending failed for {$this->registration->phone}: {$e->getMessage()}");
        }
    }
}
