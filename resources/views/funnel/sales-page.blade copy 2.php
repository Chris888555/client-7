<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Separated Earnings Cards</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 flex flex-col items-center justify-center min-h-screen space-y-8">

  <!-- Overall Earnings Card -->
  <div class="max-w-[300px] w-full rounded-xl overflow-hidden shadow-sm border border-gray-100 bg-white">
    <!-- Header -->
    <div class="bg-[#0b1b48] text-white px-4 py-5 flex justify-between items-center rounded-t-xl">
      <h3 class="text-sm font-semibold tracking-wide">OVERALL EARNINGS</h3>
      <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" stroke-width="6" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
      </svg>
    </div>

    <!-- Body -->
    <div class="bg-white py-5 text-left border border-gray-200 rounded-xl m-4 p-4">
      <p class="text-xs text-gray-500 font-medium mb-1">TOTAL EARNINGS</p>
      <p class="text-2xl font-bold text-[#0b1b48]">P73,350.00</p>
    </div>
  </div>

  <!-- Available Balance Card -->
  <div class="max-w-[300px] w-full rounded-xl overflow-hidden shadow-sm border border-gray-100 bg-white">
    <!-- Header -->
    <div class="bg-[#0b1b48] text-white px-4 py-5 flex justify-between items-center rounded-t-xl">
      <h3 class="text-sm font-semibold tracking-wide">AVAILABLE BALANCE</h3>
      <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" stroke-width="6" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
      </svg>
    </div>

    <!-- Body -->
    <div class="bg-white py-5 text-left border border-gray-200 rounded-xl m-4 p-4">
      <p class="text-xs text-gray-500 font-medium mb-1">TOTAL AVAILABLE BALANCE</p>
      <p class="text-2xl font-bold text-[#0b1b48]">P8,270.00</p>
    </div>
  </div>

</body>
</html>
