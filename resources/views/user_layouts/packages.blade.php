@extends('layouts.users')

@section('title', 'Packages')

@section('head')
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
@endsection

@section('content')
<div class="grid gap-8 md:grid-cols-3  p-8">
    {{-- Starter Package --}}
    <div class="rounded-3xl p-8 ring-1 ring-gray-200 border-2">
        <h2 class="text-lg font-semibold leading-8 text-gray-900">Standard Package</h2>
        <p class="mt-4 text-sm leading-6 text-gray-600">Lowest Position Reservation!</p>
        <p class="mt-6 flex items-baseline gap-x-1">
            <span class="text-4xl font-bold tracking-tight text-gray-900">₱0.00</span>
        </p>
        <a href="#" aria-disabled="true" disabled
            class="mt-6 block rounded-md bg-red-400 px-3 py-2 text-center text-sm font-semibold leading-6 text-white">
      Current Account
    </a>
    <ul role=" list" class="mt-8 space-y-3 text-sm leading-6 text-gray-600">
            <li class="flex gap-x-3 items-center"><span class="material-icons text-teal-600">check_circle</span>
                Genealogy Position</li>
            <li class="flex gap-x-3 items-center"><span class="material-icons text-teal-600">check_circle</span> Free
                Products</li>
            <li class="flex gap-x-3 items-center"><span class="material-icons text-teal-600">check_circle</span>
                Personal Seacrest Account</li>
            <li class="flex gap-x-3 items-center"><span class="material-icons text-teal-600">check_circle</span>
                Logistics Facilitation</li>
            <li class="flex gap-x-3 items-center"><span class="material-icons text-teal-600">check_circle</span> Online
                Store</li>
            <li class="flex gap-x-3 items-center"><span class="material-icons text-teal-600">check_circle</span> No
                Overhead Expenses</li>
            <li class="flex gap-x-3 items-center"><span class="material-icons text-teal-600">check_circle</span> Free
                Trainings/Seminars</li>
            <li class="flex gap-x-3 items-center"><span class="material-icons text-teal-600">check_circle</span>
                Subscription Bonus</li>
            <li class="flex gap-x-3 items-center"><span class="material-icons text-teal-600">check_circle</span> Weekly
                Commissions</li>
            <li class="flex gap-x-3 items-center"><span class="material-icons text-teal-600">check_circle</span> Rank
                Advancement Bonuses</li>
            <li class="flex gap-x-3 items-center"><span class="material-icons text-red-600">cancel</span> Matching
                Bonuses</li>
            <li class="flex gap-x-3 items-center"><span class="material-icons text-red-600">cancel</span> Referral Link
                Customization</li>
            <li class="flex gap-x-3 items-center"><span class="material-icons text-red-600">cancel</span> Full Referral
                Points Benefits</li>
            <li class="flex gap-x-3 items-center"><span class="material-icons text-red-600">cancel</span> Product
                Rebates</li>
            <li class="flex gap-x-3 items-center"><span class="material-icons text-red-600">cancel</span> Lifetime
                Product Discounts</li>
            </ul>

    </div>

    {{-- Regular Package --}}
    <div class="rounded-3xl p-8 ring-1 ring-gray-200 border-2">
        <h2 class="text-lg font-semibold leading-8 text-gray-900">Gold Package</h2>
        <p class="mt-4 text-sm leading-6 text-gray-600">Basic Package for Regular Users</p>
        <p class="mt-6 flex items-baseline gap-x-1">
            <span class="text-4xl font-bold tracking-tight text-gray-900">₱5,999.00</span>
        </p>
        <a href="#"
            class="mt-6 block rounded-md bg-yellow-400 px-3 py-2 text-center text-sm font-semibold leading-6 text-white ">
           Upgrade Package
        </a>
        <ul role="list" class="mt-8 space-y-3 text-sm leading-6 text-gray-600">
            <li class="flex gap-x-3 items-center"><span class="material-icons text-teal-600">check_circle</span>
                Genealogy Position</li>
            <li class="flex gap-x-3 items-center"><span class="material-icons text-teal-600">check_circle</span> Free
                Products</li>
            <li class="flex gap-x-3 items-center"><span class="material-icons text-teal-600">check_circle</span>
                Personal Seacrest Account</li>
            <li class="flex gap-x-3 items-center"><span class="material-icons text-teal-600">check_circle</span>
                Logistics Facilitation</li>
            <li class="flex gap-x-3 items-center"><span class="material-icons text-teal-600">check_circle</span> Online
                Store</li>
            <li class="flex gap-x-3 items-center"><span class="material-icons text-teal-600">check_circle</span> No
                Overhead Expenses</li>
            <li class="flex gap-x-3 items-center"><span class="material-icons text-teal-600">check_circle</span> Free
                Trainings/Seminars</li>
            <li class="flex gap-x-3 items-center"><span class="material-icons text-teal-600">check_circle</span>
                Subscription Bonus</li>
            <li class="flex gap-x-3 items-center"><span class="material-icons text-teal-600">check_circle</span> Product
                Rebates</li>
            <li class="flex gap-x-3 items-center"><span class="material-icons text-teal-600">check_circle</span>
                Lifetime Product Discounts</li>
            <li class="flex gap-x-3 items-center"><span class="material-icons text-teal-600">check_circle</span> Weekly
                Commissions</li>
            <li class="flex gap-x-3 items-center"><span class="material-icons text-teal-600">check_circle</span> Rank
                Advancement Bonuses</li>
            <li class="flex gap-x-3 items-center"><span class="material-icons text-red-600">cancel</span> Matching
                Bonuses</li>
            <li class="flex gap-x-3 items-center"><span class="material-icons text-red-600">cancel</span> Referral Link
                Customization</li>
            <li class="flex gap-x-3 items-center"><span class="material-icons text-red-600">cancel</span> Full Referral
                Points Benefits</li>
        </ul>

    </div>

    {{-- Premium Package --}}
    <div class="rounded-3xl p-8 ring-1 ring-gray-200">
        <h2 class="text-lg font-semibold leading-8 text-gray-900">Platinum Package</h2>
        <p class="mt-4 text-sm leading-6 text-gray-600">Best for business</p>
        <p class="mt-6 flex items-baseline gap-x-1">
            <span class="text-4xl font-bold tracking-tight text-gray-900">₱13,999.00</span>
        </p>
        <a href="#"
            class="mt-6 block rounded-md bg-blue-400 px-3 py-2 text-center text-sm font-semibold leading-6 text-white">
           Upgrade Package
        </a>
        <ul role="list" class="mt-8 space-y-3 text-sm leading-6 text-gray-600">
            <li class="flex gap-x-3 items-center"><span class="material-icons text-teal-600">check_circle</span>
                Genealogy Position</li>
            <li class="flex gap-x-3 items-center"><span class="material-icons text-teal-600">check_circle</span> Free
                Products</li>
            <li class="flex gap-x-3 items-center"><span class="material-icons text-teal-600">check_circle</span>
                Personal Seacrest Account</li>
            <li class="flex gap-x-3 items-center"><span class="material-icons text-teal-600">check_circle</span>
                Logistics Facilitation</li>
            <li class="flex gap-x-3 items-center"><span class="material-icons text-teal-600">check_circle</span> Online
                Store</li>
            <li class="flex gap-x-3 items-center"><span class="material-icons text-teal-600">check_circle</span> No
                Overhead Expenses</li>
            <li class="flex gap-x-3 items-center"><span class="material-icons text-teal-600">check_circle</span> Free
                Trainings/Seminars</li>
            <li class="flex gap-x-3 items-center"><span class="material-icons text-teal-600">check_circle</span>
                Subscription Bonus</li>
            <li class="flex gap-x-3 items-center"><span class="material-icons text-teal-600">check_circle</span> Product
                Rebates</li>
            <li class="flex gap-x-3 items-center"><span class="material-icons text-teal-600">check_circle</span>
                Lifetime Product Discounts</li>
            <li class="flex gap-x-3 items-center"><span class="material-icons text-teal-600">check_circle</span> Weekly
                Commissions</li>
            <li class="flex gap-x-3 items-center"><span class="material-icons text-teal-600">check_circle</span> Rank
                Advancement Bonuses</li>
            <li class="flex gap-x-3 items-center"><span class="material-icons text-teal-600">check_circle</span>
                Matching Bonuses</li>
            <li class="flex gap-x-3 items-center"><span class="material-icons text-red-600">cancel</span> Referral Link
                Customization</li>
            <li class="flex gap-x-3 items-center"><span class="material-icons text-red-600">cancel</span> Full Referral
                Points Benefits</li>
        </ul>

    </div>
</div>
@endsection