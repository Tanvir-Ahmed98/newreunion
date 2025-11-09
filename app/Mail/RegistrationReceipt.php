<?php

namespace App\Mail;

use App\Models\Registration;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class RegistrationReceipt extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public Registration $registration;
    public string $paymentLink;

    public function __construct(Registration $registration, string $paymentLink)
    {
        $this->registration = $registration;
        $this->paymentLink  = $paymentLink;
    }

    public function build()
    {
        return $this->subject('🎓 EUSCIANS Reunion 2026 Registration Confirmation')
                    ->markdown('emails.registration.receipt', [
                        'registration' => $this->registration,
                        'paymentLink'  => $this->paymentLink,
                    ]);
    }
}
