@extends('layouts.app')

@section('title', 'Funnel Setting')

@section('content')

@include('includes.nav')

<div class="container m-auto p-4 sm:p-8 max-w-full">

    <h1 class="text-2xl md:text-3xl font-bold text-left">Update Funnel Details for All Users</h1>
    <p class="text-gray-600 text-left mb-4">Update and manage the funnel details for all users to ensure consistent
        performance and user experience.</p>




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

                <!-- SVG Icon before the text, vertically centered -->
                <svg class="h-6 w-6 text-slate-50 inline-block mr-2" width="16" height="16" viewBox="0 0 24 24"
                    stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" />
                    <line x1="20" y1="12" x2="10" y2="12" />
                    <line x1="20" y1="12" x2="16" y2="16" />
                    <line x1="20" y1="12" x2="16" y2="8" />
                    <line x1="4" y1="4" x2="4" y2="20" />
                </svg>

                Save Settings for All Users
            </button>
        </div>
    </form>
</div>
@endsection