<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Confirm Your Payment</title>
  <link href="https://cdn.tailwindcss.com" rel="stylesheet">
</head>
<body class="bg-slate-100 text-slate-800 flex items-center justify-center min-h-screen">
  <div class="bg-white p-8 rounded-2xl shadow-lg max-w-md w-full">
    <h2 class="text-2xl font-bold text-center mb-4">Confirm Your Payment</h2>

    <p class="text-slate-600 text-center mb-6">
      Registration ID: <strong>{{ $registration->client_reg_id }}</strong><br>
      Amount: <strong>{{ number_format($registration->payable_amount, 2) }} BDT</strong>
    </p>

    <form method="POST" action="{{ route('payment.submit', $registration->payment_token) }}" class="space-y-5">
      @csrf
      <div>
        <label for="transaction_id" class="block font-semibold mb-1">bKash Transaction ID</label>
        <input type="text" name="transaction_id" id="transaction_id" required
               class="w-full border border-slate-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-teal-400 outline-none">
      </div>

      <button type="submit"
              class="w-full bg-teal-500 text-white font-bold py-2 rounded-lg hover:brightness-95 transition">
        Submit Payment Confirmation
      </button>
    </form>
  </div>
</body>
</html>
