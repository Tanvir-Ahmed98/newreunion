<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Payment Confirmed</title>
  <link href="https://cdn.tailwindcss.com" rel="stylesheet">
</head>
<body class="bg-green-50 text-slate-800 flex items-center justify-center min-h-screen">
  <div class="bg-white p-8 rounded-2xl shadow-lg max-w-md w-full text-center">
    <h2 class="text-2xl font-bold text-green-600 mb-3">✅ Payment Confirmed!</h2>
    <p class="text-slate-700 mb-4">
      Thank you, {{ $registration->name }}.<br>
      Your payment for the <strong>EUSCIANS Reunion 2026</strong> has been received.
    </p>
    <p class="text-sm text-slate-500">
      Registration ID: {{ $registration->client_reg_id }}<br>
      Transaction ID: {{ $registration->transaction_id }}
    </p>
  </div>
</body>
</html>
