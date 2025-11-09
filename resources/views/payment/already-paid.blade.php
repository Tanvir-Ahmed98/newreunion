<!-- resources/views/payment/already-paid.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Payment Already Confirmed</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@3.4.0/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-slate-100 text-slate-800 flex items-center justify-center min-h-screen">

    <div class="bg-white shadow-xl rounded-2xl p-8 max-w-lg text-center border border-slate-200">
        <h1 class="text-2xl font-extrabold text-green-600 mb-3">✅ Payment Already Confirmed</h1>
        <p class="text-slate-700 leading-relaxed">
            Hi <strong>{{ $registration->name }}</strong>,<br>
            Our records show that your registration payment for the
            <span class="font-semibold">EUSCIANS Reunion 2026</span> has already been confirmed.
        </p>

        <div class="mt-6 bg-green-50 border border-green-200 rounded-xl p-4 text-left">
            <p><strong>Registration ID:</strong> {{ $registration->client_reg_id }}</p>
            <p><strong>Transaction ID:</strong> {{ $registration->transaction_id }}</p>
            <p><strong>Status:</strong> <span class="text-green-700 font-semibold">Paid</span></p>
        </div>

        <p class="text-sm text-slate-500 mt-6">
            Need help? Contact us via WhatsApp at
            <span class="font-semibold text-teal-600">01410969009</span>.
        </p>
    </div>

</body>
</html>
