@extends('layouts.users')

@section('title', 'Dashboard')

@section('content')
<div class="p-6 bg-gray-100 min-h-screen">
    <h1 class="text-3xl font-bold text-gray-800 mb-6">Admin Dashboard</h1>

    <!-- Stats Section (Static data muna) -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
        <div class="bg-white shadow rounded-lg p-4">
            <h2 class="text-sm font-semibold text-gray-500">Total Users</h2>
            <p class="text-2xl font-bold text-blue-600">1,204</p>
        </div>
        <div class="bg-white shadow rounded-lg p-4">
            <h2 class="text-sm font-semibold text-gray-500">Total Sales</h2>
            <p class="text-2xl font-bold text-green-600">₱350,000</p>
        </div>
        <div class="bg-white shadow rounded-lg p-4">
            <h2 class="text-sm font-semibold text-gray-500">New Signups</h2>
            <p class="text-2xl font-bold text-purple-600">58</p>
        </div>
    </div>

    <!-- Recent Members Table (Static content) -->
    <div class="bg-white shadow rounded-lg p-6">
        <h2 class="text-xl font-semibold text-gray-700 mb-4">Recent Members</h2>
        <table class="min-w-full table-auto text-left">
            <thead>
                <tr class="bg-gray-200 text-gray-600 text-sm uppercase">
                    <th class="px-4 py-2">Name</th>
                    <th class="px-4 py-2">Email</th>
                    <th class="px-4 py-2">Joined</th>
                </tr>
            </thead>
            <tbody>
                <tr class="border-b">
                    <td class="px-4 py-2">Juan Dela Cruz</td>
                    <td class="px-4 py-2">juan@example.com</td>
                    <td class="px-4 py-2">May 18, 2025</td>
                </tr>
                <tr class="border-b">
                    <td class="px-4 py-2">Maria Santos</td>
                    <td class="px-4 py-2">maria@example.com</td>
                    <td class="px-4 py-2">May 17, 2025</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection
