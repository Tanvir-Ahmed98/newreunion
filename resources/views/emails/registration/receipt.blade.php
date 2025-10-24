@php
    $amount = number_format((float) $registration->payable_amount, 2);
    $regId = $registration->client_reg_id ?? $registration->id;
@endphp

@component('mail::message')
# Thank you, {{ $registration->name }} 🎉

We’ve received your registration for the **EUSCAA Reunion**.

## Registration Details
- **Registration ID:** {{ $regId }}
- **Email:** {{ $registration->email }}
- **Phone:** {{ $registration->phone }}
- **Location:** {{ $registration->location }}
- **Profession:** {{ $registration->profession ?? 'N/A' }}
- **Batch:** {{ $registration->batch ?? 'N/A' }}
- **Guests (Total):** {{ (int) $registration->guests_total }}
- **Guests (12+):** {{ (int) $registration->guest_above_12 }}
- **T-shirt Size:** {{ $registration->tshirt_size ?? 'N/A' }}

## Payment
- **Payable Amount:** **৳ {{ $amount }}**

@component('mail::panel')
Keep your Registration ID handy for any queries.  
If you uploaded a photo, our team will review it shortly.
@endcomponent

Thanks,  
**EUSCAA Reunion Team**
@endcomponent
