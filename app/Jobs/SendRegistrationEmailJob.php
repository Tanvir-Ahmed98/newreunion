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
        // ✅ Generate the payment link for this user
        $paymentLink = url('/payment/' . $this->registration->payment_token);

        // ✅ Send the email using the Mailable class
        Mail::to($this->registration->email)
            ->send(new RegistrationReceipt($this->registration, $paymentLink));
    }
}
