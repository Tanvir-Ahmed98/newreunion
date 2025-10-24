<?php

namespace App\Mail;

use App\Models\Registration;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RegistrationReceipt extends Mailable
{
    use Queueable, SerializesModels;

    public Registration $registration;

    public function __construct(Registration $registration)
    {
        $this->registration = $registration;
    }

    public function build()
    {
        return $this->subject('Your EUSCAA Reunion Registration Confirmation')
            ->markdown('emails.registration.receipt', [
                'registration' => $this->registration,
            ]);
    }
}
