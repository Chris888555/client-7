@extends('layouts.users')

@section('title', 'Rank Status')

@section('content')
<div class="container m-auto p-4 sm:p-8 max-w-full">

<div class="flex flex-col md:flex-row gap-6 justify-center mt-8">

  <!-- Info Card -->
  <div class="bg-white p-6 rounded-lg border flex-1 ">
    <h2 class="text-2xl font-bold text-teal-600 mb-4">Your Current Status</h2>
    <p class="text-gray-700 text-lg">
      You are currently an <span class="font-bold">Affiliate</span>. To level up to 
      <span class="text-blue-600 font-semibold">Dreamer Rank</span>, you must enroll 
      <span class="font-bold">10 direct referrals</span> within <span class="font-bold">1 month</span>.
    </p>
    <p class="mt-4 text-green-600 font-semibold">
      Achieve this to unlock exclusive rewards.
    </p>
  </div>

  <!-- Progress Card -->
  <div class="bg-white p-6 rounded-lg border flex-1 ">
    <h2 class="text-2xl font-bold text-teal-600  mb-4">Progress</h2>
    <p class="text-gray-700 text-lg mb-2">
      Direct referrals enrolled: <span class="text-blue-600">4</span>
    </p>
    <p class="text-gray-700 text-lg mb-4">
      Referrals needed to level up:<span class="text-red-600">6</span>
    </p>
    <div class="w-full bg-gray-200 rounded-full h-4">
      <div class="bg-blue-600 h-4 rounded-full" style="width: 40%;"></div>
    </div>
    <p class="text-sm text-gray-500 mt-2">40% completed</p>
  </div>

</div>
</div>
@endsection
