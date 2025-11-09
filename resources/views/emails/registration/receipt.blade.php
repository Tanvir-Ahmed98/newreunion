@php
    $amount = number_format((float) $registration->payable_amount, 2);
    $regId = $registration->client_reg_id ?? $registration->id;
@endphp

@component('mail::message')
# 🎓 Thank you, {{ $registration->name }}!

We’ve received your registration for the **EUSCIANS Reunion 2026**.

---

## 🪪 Registration Details
- **Registration ID:** {{ $regId }}
- **Email:** {{ $registration->email }}
- **Phone:** {{ $registration->phone }}
- **Location:** {{ $registration->location }}
- **Profession:** {{ $registration->profession ?? 'N/A' }}
- **Batch:** {{ $registration->batch ?? 'N/A' }}
- **Guests (Total):** {{ (int) $registration->guests_total }}
- **T-shirt Size:** {{ $registration->tshirt_size ?? 'N/A' }}

---

## 💰 Payment Instructions
- **Payable Amount:** **৳ {{ $amount }}**
- **Payment Method:** bKash (Merchant Account): **+8801879996066 (EUSCAA)**
- **Reference ID:** **{{ $regId }}**
- Please pay within **48 hours** to confirm your registration.  
- Unpaid forms will be **automatically cancelled**.

---

@component('mail::button', ['url' => $paymentLink, 'color' => 'success'])
🔗 Confirm Payment & Submit Transaction ID
@endcomponent

---

@component('mail::panel')
Keep your Registration ID handy for any queries.  
If you uploaded a photo, our team will review it shortly.  
**Helpline:** 01410969009 (WhatsApp)
@endcomponent

Thanks,  
**EUSCAA Reunion Team**

@endcomponent
