@extends('layouts.app')

@section('title', 'Funnel Toggle Setting')

@section('content')

@include('includes.nav')

  <div class="container m-auto p-4 sm:p-8 max-w-full">
        <h1 class="text-3xl font-bold mb-6">Admin Settings</h1>

        <!-- Show success message if setting is updated -->
        @if(session('status'))
            <div class="alert alert-success bg-green-500 text-white p-4 rounded-lg mb-4">
                {{ session('status') }}
            </div>
        @endif

        <!-- Show error if no setting is found -->
        @if(session('error'))
            <div class="alert alert-danger bg-red-500 text-white p-4 rounded-lg mb-4">
                {{ session('error') }}
            </div>
        @endif

        <form action="{{ route('settings.update') }}" method="POST">
            @csrf
            <div class="form-group mb-6 flex items-center">
                <label for="setting_value" class="block text-lg font-semibold mr-4">Enable Feature:</label>
                
                <!-- Toggle switch with text labels for ON/OFF -->
                <div class="flex items-center">
                    <span class="text-sm mr-2">OFF</span>
                    <div class="relative inline-block w-14 mr-2 align-middle select-none transition duration-200 ease-in border-2 border-gray-300 rounded-full">
                        <input type="checkbox" name="setting_value" id="setting_value" 
                               class="toggle-checkbox absolute block w-6 h-6 rounded-full bg-white border-4 appearance-none cursor-pointer" 
                               {{ isset($setting) && $setting->setting_value == 'ON' ? 'checked' : '' }}>
                        <label for="setting_value" 
                               class="toggle-label block overflow-hidden h-6 rounded-full bg-gray-300 cursor-pointer"></label>
                    </div>
                    <span class="text-sm ml-2">ON</span>
                </div>

            </div>

                <p class="text-sm text-gray-600 mt-2">
                    <strong>Note:</strong> When this is <span class="text-green-600 font-semibold">ON</span>, the subscription of the funnel is <span class="font-semibold">enabled</span>.<br>
                    When <span class="text-red-600 font-semibold">OFF</span>, the funnel subscription is <span class="font-semibold">disabled</span>.
                </p>

            <button type="submit" class="flex items-center gap-2 bg-blue-500 text-white py-2 px-6 mt-6 rounded-lg hover:bg-blue-600 transition-colors duration-200">
    <svg class="h-4 w-4 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z" />
        <polyline points="17 21 17 13 7 13 7 21" />
        <polyline points="7 3 7 8 15 8" />
    </svg>
    Save Changes
</button>


        </form>
    </div>

    <style>
        /* Toggle switch custom style */
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
@endsection
