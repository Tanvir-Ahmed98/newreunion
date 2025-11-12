@php
    $amount = number_format((float) $registration->payable_amount, 2);
    $regId = $registration->client_reg_id ?? $registration->id;
    $isForeignAlumni = $registration->live_abroad === 'yes';
@endphp

@component('mail::message')
# 🎓 Thank you, {{ $registration->name }}!

We've received your registration for the **EUSCIANS Reunion 2026**.

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

@if($isForeignAlumni)
- **Payment Method:** Bank Transfer
- **Bank Account Details:**
  Engineering University School and College Alumni A  
  Sonali Bank PLC (BUET Branch)  
  **Branch Code:** 44040  
  **Account Number:** 4404001029291  
  **Routing Number:** 200270522
- **Reference ID:** **{{ $regId }}**
- Please send an email to **euscians@gmail.com** with your receipt number/screenshot of the payment confirmation, including your Reference ID: **{{ $regId }}**
@else
- **Payment Method:** bKash (Merchant Account): **+8801879996066 (EUSCAA)**
- **Reference ID:** **{{ $regId }}**
- Please pay within **48 hours** to confirm your registration.
@endif

- Unpaid forms will be **automatically cancelled**.

---

@if(!$isForeignAlumni)
@component('mail::button', ['url' => $paymentLink, 'color' => 'success'])
🔗 Confirm Payment & Submit Transaction ID
@endcomponent
@endif

---

@component('mail::panel')
Keep your Registration ID handy for any queries.  
@if($registration->photo)
If you uploaded a photo, our team will review it shortly.  
@endif
**Helpline:** 01410969009 (WhatsApp)  
**Email:** euscians@gmail.com
@endcomponent

Please don't reply to this email. If you have any questions, feel free to contact us at 01410969009 (WhatsApp) or euscians@gmail.com.

Thanks,  
**EUSCIANS Reunion 2026 Organizing Committee**  
Engineering University School & College Alumni Association (EUSCAA)

@endcomponent