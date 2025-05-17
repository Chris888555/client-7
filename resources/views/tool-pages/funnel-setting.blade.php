@extends('layouts.app')

@section('title', 'Funnel Setting')

@section('content')



<div class="container m-auto p-4 sm:p-8 max-w-full">

    <h1 class="text-2xl md:text-3xl font-bold text-left text-blue-400">Update Funnel Details for All Users</h1>
    <p class="text-gray-600 text-left mb-4">Update and manage the funnel details for all users to ensure consistent
        performance and user experience.</p>

    <!-- Admin Toggle Form (First Form) -->
    <form action="{{ route('settings.update') }}" method="POST">
        @csrf
        <div class="form-group mb-6 flex items-center">
            <label for="setting_value" class="block text-lg font-semibold mr-4">Enable Feature:</label>

            <div class="flex items-center">
                <span class="text-sm mr-2">OFF</span>
                <div class="relative inline-block w-14 mr-2 align-middle select-none transition duration-200 ease-in border-2 border-gray-300 rounded-full">
                    <input type="hidden" name="setting_value" value="OFF">
                    <input type="checkbox" name="setting_value" id="setting_value" value="ON"
                        class="toggle-checkbox absolute block w-6 h-6 rounded-full bg-white border-4 appearance-none cursor-pointer"
                        {{ isset($setting) && $setting->setting_value == 'ON' ? 'checked' : '' }}>
                    <label for="setting_value"
                        class="toggle-label block overflow-hidden h-6 rounded-full bg-gray-300 cursor-pointer"></label>
                </div>
                <span class="text-sm ml-2">ON</span>
            </div>
        </div>

        <p class="text-sm text-gray-600 mt-2">
            <strong>Note:</strong> When this is <span class="text-green-600 font-semibold">ON</span>, the subscription
            of the funnel is <span class="font-semibold">enabled</span>.<br>
            When <span class="text-red-600 font-semibold">OFF</span>, the funnel subscription is <span
                class="font-semibold">disabled</span>.
        </p>

        <button type="submit"
                class="rounded-lg bg-blue-700 mt-4 mb-8 px-6 py-2 text-sm font-medium text-white shadow-sm transition duration-200 hover:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50 flex items-center">

                <svg class="h-5 w-5 text-white mr-2" width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                    stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" />
                    <path d="M6 4h10l4 4v10a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2" />
                    <circle cx="12" cy="14" r="2" />
                    <polyline points="14 4 14 8 8 8 8 4" />
                </svg>

                Save Changes
            </button>
    </form>

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

        .toggle-checkbox:checked+.toggle-label {
            background-color: #4CAF50;
        }
    </style>

<div class="bg-gray-100 p-4 rounded-lg shadow-inner">

    <!-- Funnel Settings Form (Second Form) -->
    <form action="{{ route('funnel.settings.save') }}" method="POST" class="space-y-5">
        @csrf

        <div>
            <label for="facebook_link" class="block font-medium text-gray-700">Messenger Link</label>
            <input type="url" name="facebook_link" id="facebook_link"
                value="{{ old('facebook_link', $defaults->facebook_link ?? '') }}"
                class="mt-2 w-full border border-gray-300 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <div>
            <label for="join_fb_group" class="block font-medium text-gray-700">Group Chat Link</label>
            <input type="url" name="join_fb_group" id="join_fb_group"
                value="{{ old('join_fb_group', $defaults->join_fb_group ?? '') }}"
                class="mt-2 w-full border border-gray-300 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <div>
            <label for="page_link" class="block font-medium text-gray-700">Page Link Or Referral Link</label>
            <input type="url" name="page_link" id="page_link" value="{{ old('page_link', $defaults->page_link ?? '') }}"
                class="mt-2 w-full border border-gray-300 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <div>
            <label for="headline" class="block font-medium text-gray-700">Headline</label>
            <input type="text" name="headline" id="headline" value="{{ old('headline', $defaults->headline ?? '') }}"
                class="mt-2 w-full border border-gray-300 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <div>
            <label for="subheadline" class="block font-medium text-gray-700">Subheadline</label>
            <input type="text" name="subheadline" id="subheadline"
                value="{{ old('subheadline', $defaults->subheadline ?? '') }}"
                class="mt-2 w-full border border-gray-300 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <div>
            <label for="video_link" class="block font-medium text-gray-700">Video Link (YouTube or .mp4)</label>
            <input type="url" name="video_link" id="video_link"
                value="{{ old('video_link', $defaults->video_link ?? '') }}"
                class="mt-2 w-full border border-gray-300 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <div>
            <button type="submit"
                class="rounded-lg bg-blue-700 px-6 py-2 text-sm font-medium text-white shadow-sm transition duration-200 hover:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50 flex items-center">

                <svg class="h-5 w-5 text-white mr-2" width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                    stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" />
                    <path d="M6 4h10l4 4v10a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2" />
                    <circle cx="12" cy="14" r="2" />
                    <polyline points="14 4 14 8 8 8 8 4" />
                </svg>

                Save Changes
            </button>
        </div>
    </form>
</div>
</div>
@endsection
