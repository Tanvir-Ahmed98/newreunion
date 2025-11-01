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
            $phone          = $this->registration->phone;
            $name           = $this->registration->name;
            $amount         = $this->registration->payable_amount;
            $referenceId    = $this->registration->client_reg_id;

            // ? Personalized message using real model fields
            $message = "Dear EUSCIANS,"
                     . "Please pay {$amount} BDT via bKash(01879996066) with ref:{$referenceId}. "
                     . "to confirm your Reunion 2026 registration. Helpline: 01734442666";

            // ? Send SMS via sms_net_bd\SMS
            $sms = new SMS();
            $sms->sendSMS($message, $phone);

            \Log::info("? SMS sent to {$phone} for registration ID {$referenceId}");

        } catch (\Throwable $e) {
            \Log::error("? SMS sending failed for {$this->registration->phone}: {$e->getMessage()}");
        }
    }
}