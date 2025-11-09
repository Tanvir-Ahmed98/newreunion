<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Payment Link Invalid</title>
  <link href="https://cdn.tailwindcss.com" rel="stylesheet">
</head>
<body class="bg-red-50 text-slate-800 flex items-center justify-center min-h-screen">
  <div class="bg-white p-8 rounded-2xl shadow-lg max-w-md w-full text-center">
    <h2 class="text-2xl font-bold text-red-600 mb-3">⚠️ Payment Link Invalid</h2>
    <p class="text-slate-600">{{ $message ?? 'This payment link is no longer valid.' }}</p>
  </div>
</body>
</html>
