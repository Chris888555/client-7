@extends('layouts.app')

@section('title', 'Manage Funnel Plan')

@section('content')


<script src="https://cdn.jsdelivr.net/npm/alpinejs@2.8.2/dist/alpine.min.js" defer></script>

<div class="container m-auto p-4 sm:p-8 max-w-full">

<x-page-header-text 
    title="Update Funnel Details for All Users"
    subtitle="Update and manage the funnel details for all users to ensure consistent
        performance and user experience"
/>

    {{-- TOGGLE FORM --}}
    <form action="{{ route('manage-funnel-plan.toggle') }}" method="POST">
        @csrf
        <div class="form-group mb-6 flex items-center mt-6">
            <label for="setting_value" class="block text-lg font-semibold mr-4">Enable Feature:</label>

            <div class="flex items-center">
                <span class="text-sm mr-2">OFF</span>
                <div class="relative inline-block w-14 mr-2 align-middle select-none transition duration-200 ease-in border-2 border-gray-300 rounded-full">
                    <input type="hidden" name="setting_value" value="OFF">
                    <input type="checkbox" name="setting_value" id="setting_value" value="ON" class="toggle-checkbox absolute block w-6 h-6 rounded-full bg-white border-4 appearance-none cursor-pointer" {{ isset($featureSetting) && $featureSetting->setting_value == 'ON' ? 'checked' : '' }}>
                    <label for="setting_value" class="toggle-label block overflow-hidden h-6 rounded-full bg-gray-300 cursor-pointer"></label>
                </div>
                <span class="text-sm ml-2">ON</span>
            </div>
        </div>

        <p class="text-sm text-gray-600 mt-2">
            <strong>Note:</strong> When this is <span class="text-green-600 font-semibold">ON</span>, the subscription of the funnel is <span class="font-semibold">enabled</span>.<br>
            When <span class="text-red-600 font-semibold">OFF</span>, the funnel subscription is <span class="font-semibold">disabled</span>.
        </p>

        <button type="submit" class="rounded-lg bg-blue-700 mt-4 px-6 py-2 text-sm font-medium text-white shadow-sm transition duration-200 hover:bg-blue-800">
            Save Toggle
        </button>
    </form>

    {{-- TOGGLE STYLING --}}
    <style>
        .toggle-checkbox:checked {
            right: 0;
            background-color: #4CAF50;
        }

        .toggle-checkbox {
            transition: right 0.3s ease;
        }

        .toggle-label {
            position: relative;
            cursor: pointer;
            display: inline-block;
            width: 100%;
            height: 100%;
            background-color: #ccc;
            border-radius: 999px;
        }

        .toggle-checkbox:checked + .toggle-label {
            background-color: #4CAF50;
        }
    </style>

    

   {{-- MONTHS & PRICE FORM --}}
<form action="{{ route('manage-funnel-plan.store') }}" method="POST">
    @csrf
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-8">
        <div>
            <label for="months" class="block text-lg font-semibold mb-1">Plan Duration (Months):</label>
            <input type="number" name="months" id="months" min="1" max="12" value="{{ old('months', isset($funnelPlan) ? $funnelPlan->months : '') }}" required class="w-full border border-gray-300 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <div>
            <label for="price" class="block text-lg font-semibold mb-1">Plan Price (₱):</label>
            <input type="number" name="price" id="price" step="0.01" value="{{ old('price', isset($funnelPlan) ? $funnelPlan->price : '') }}" required class="w-full border border-gray-300 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>
    </div>

    <p class="text-sm text-gray-600 mt-2">
        This will create a new funnel subscription plan with the specified duration and price.
    </p>

    <button type="submit" class="rounded-lg bg-green-600 mt-4 mb-8 px-6 py-2 text-sm font-medium text-white shadow-sm transition duration-200 hover:bg-green-700">
        Create Plan
    </button>
</form>

{{-- Display Existing Plans --}}
@if($funnelPlans->isNotEmpty())
    <div class="mt-8" x-data="{ open: false, planId: null, months: '', price: '' }">
        <h2 class="text-xl font-semibold mb-4">Existing Funnel Plans</h2>

      

         <div class="overflow-x-auto bg-white border rounded-md ">
        <table class="table-auto w-full border-collapse border border-gray-300">
         <thead class="bg-gray-200 whitespace-nowrap text-left">
                <tr class="bg-gray-100">
                    <th class="border border-gray-300 px-4 py-2">Plan Duration (Months)</th>
                    <th class="border border-gray-300 px-4 py-2">Plan Price (₱)</th>
                    <th class="border border-gray-300 px-4 py-2">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($funnelPlans as $plan)
                    <tr>
                        <td class="border border-gray-300 px-4 py-2">{{ $plan->months }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ number_format($plan->price, 2) }}</td>
                        <td class="border border-gray-300 px-4 py-2 whitespace-nowrap">
                           <!-- Edit Button -->
                        <button 
                            type="button" 
                            @click="open = true; planId = {{ $plan->id }}; months = '{{ $plan->months }}'; price = '{{ $plan->price }}'" 
                            class="text-blue-500 hover:text-blue-700 bg-blue-100 hover:bg-blue-200 rounded text-sm px-2 py-1 inline-flex items-center">
                            <span class="material-icons mr-1">create</span> Edit
                        </button> 

                        <!-- Delete Button -->
                        <form action="{{ route('manage-funnel-plan.destroy', $plan->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500 hover:text-red-700 bg-red-100 hover:bg-red-200 rounded text-sm px-2 py-1 inline-flex items-center">
                                <span class="material-icons mr-1">delete</span> Delete
                            </button>
                        </form>

                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

        {{-- Modal for Editing --}}
<div x-show="open" 
    class="fixed inset-0 bg-gray-600 bg-opacity-50 flex justify-center items-center z-50" 
    @click="open = false" x-cloak>
    
    <!-- Modal Content -->
    <div class="bg-white p-6 rounded-lg w-[95%] sm:max-w-lg shadow-xl" @click.stop>
        <h2 class="text-xl font-semibold mb-4">Edit Funnel Subscription Plan</h2>
        <form method="POST" :action="'/manage-funnel-plan/' + planId">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="months" class="block text-sm font-semibold mb-1 text-gray-500">Plan Duration (Months):</label>
                <input type="number" name="months" min="1" max="12" x-model="months" required class="w-full border border-gray-300 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div class="mb-4">
                <label for="price" class="block text-sm font-semibold mb-1 text-gray-500">Plan Price (₱):</label>
                <input type="number" name="price" step="0.01" x-model="price" required class="w-full border border-gray-300 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div class="flex justify-end space-x-4">
                <button type="button" @click="open = false" class="bg-red-500 text-white px-4 py-2 rounded-md">Cancel</button>
                <button type="submit" class="bg-green-600 text-white px-6 py-2 rounded-md">Save Changes</button>
            </div>
        </form>
    </div>
</div>

    </div>
@else
    <p class="text-sm text-gray-600 mt-4">No funnel plans available.</p>
@endif


</div>
@endsection
