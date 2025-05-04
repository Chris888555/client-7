@extends('layouts.app')

@section('title', 'Edit Funnel Links')

@section('content')

@include('includes.nav')


<main class="container m-auto p-4 sm:p-8 max-w-full">
    <!-- <div class="mb-4">
        <a href="{{ route('funnel.main') }}"
            class="inline-flex items-center px-4 py-2 bg-gradient-to-br from-indigo-600 to-purple-500 text-white rounded-lg hover:bg-blue-600">
            <svg class="h-6 w-6 text-white mr-2" width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" />
                <line x1="5" y1="12" x2="19" y2="12" />
                <line x1="5" y1="12" x2="9" y2="16" />
                <line x1="5" y1="12" x2="9" y2="8" />
            </svg>
            Go Back
        </a>
    </div> -->


    <h1 class="text-2xl md:text-3xl font-bold text-left">Update Your Funnel</h1>
    <p class="text-gray-600 text-left mb-4">Manage your sales funnel details</p>

    <form action="{{ route('save-funnel') }}" method="POST">
        @csrf

        <!-- New Fields for Headline, Subheadline, and Video Link -->
        <div
            class="mb-4 p-6 rounded-lg shadow-[0px_2px_3px_-1px_rgba(0,0,0,0.1),0px_1px_0px_0px_rgba(25,28,33,0.02),0px_0px_0px_1px_rgba(25,28,33,0.08)]">
            <label for="headline" class="block text-lg font-medium">Headline</label>
            <input type="text" name="headline" id="headline"
                class="mt-2  block w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none text-gray-800"
                value="{{ old('headline', $user->headline) }}">
            @error('headline')
            <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
            @enderror
        </div>

        <div
            class="mb-4 p-6 rounded-lg shadow-[0px_2px_3px_-1px_rgba(0,0,0,0.1),0px_1px_0px_0px_rgba(25,28,33,0.02),0px_0px_0px_1px_rgba(25,28,33,0.08)]">
            <label for="subheadline" class="block text-lg font-medium">Subheadline</label>
            <input type="text" name="subheadline" id="subheadline"
                class="mt-2  block w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none text-gray-800"
                value="{{ old('subheadline', $user->subheadline) }}">
            @error('subheadline')
            <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
            @enderror
        </div>

        <div
            class="mb-4 p-6 rounded-lg shadow-[0px_2px_3px_-1px_rgba(0,0,0,0.1),0px_1px_0px_0px_rgba(25,28,33,0.02),0px_0px_0px_1px_rgba(25,28,33,0.08)]">
            <label for="video_link" class="block text-lg font-medium">Sales funnel video (mp4 or youtube video
                link)</label>
            <input type="url" name="video_link" id="video_link"
                class="mt-2  block w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none text-gray-800"
                value="{{ old('video_link', $user->video_link) }}">
            @error('video_link')
            <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
            @enderror
        </div>

        <!-- Existing Form Fields -->
        <div
            class="mb-4 p-6 rounded-lg shadow-[0px_2px_3px_-1px_rgba(0,0,0,0.1),0px_1px_0px_0px_rgba(25,28,33,0.02),0px_0px_0px_1px_rgba(25,28,33,0.08)]">
            <label for="facebook_link" class="block text-lg font-medium">Messenger or fb link</label>
            <input type="url" name="facebook_link" id="facebook_link"
                class="mt-2  block w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none text-gray-800"
                value="{{ old('facebook_link', $user->facebook_link) }}">
            @error('facebook_link')
            <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
            @enderror
        </div>

         <div
            class="mb-4 p-6 rounded-lg shadow-[0px_2px_3px_-1px_rgba(0,0,0,0.1),0px_1px_0px_0px_rgba(25,28,33,0.02),0px_0px_0px_1px_rgba(25,28,33,0.08)]">
            <label for="page_link" class="block text-lg font-medium">Your referral link or payment-form</label>
            <input type="url" name="page_link" id="page_link"
                class="mt-2  block w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none text-gray-800"
                value="{{ old('page_link', $user->page_link) }}">
            @error('page_link')
            <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
            @enderror

            <div class="mt-4 flex items-center">
                <label for="page_toggle" class="text-red-500 block text-[15px] sm:text-lg font-medium mr-4">Check To
                    Show On Page | Uncheck To Hide
                    On Page</label>
                <input type="hidden" name="page_toggle" value="0">
                <input type="checkbox" name="page_toggle" id="page_toggle"
                    class="h-6 w-6 text-blue-600 focus:ring-blue-500 border-gray-300 rounded-lg" value="1"
                    {{ old('page_toggle', $user->page_toggle) ? 'checked' : '' }}>
            </div>
        </div>

        <div
            class="mb-4 p-6 rounded-lg shadow-[0px_2px_3px_-1px_rgba(0,0,0,0.1),0px_1px_0px_0px_rgba(25,28,33,0.02),0px_0px_0px_1px_rgba(25,28,33,0.08)]">
            <label for="join_fb_group" class="block text-lg font-medium">Your inquiry group chat link</label>
            <input type="url" name="join_fb_group" id="join_fb_group"
                class="mt-2  block w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none text-gray-800"
                value="{{ old('join_fb_group', $user->join_fb_group) }}">
            @error('join_fb_group')
            <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
            @enderror

            <div class=" mt-4 flex items-center">
                <label for="join_fb_group_toggle"
                    class="text-red-500 block text-[15px] sm:text-lg font-medium mr-4">Check To Show On Page |
                    Uncheck To Hide On Page</label>
                <input type="hidden" name="group_toggle" value="0">
                <input type="checkbox" name="group_toggle" id="group_toggle"
                    class="h-6 w-6 text-blue-600 focus:ring-blue-500 border-gray-300 rounded-lg" value="1"
                    {{ old('group_toggle', $user->group_toggle) ? 'checked' : '' }}>
            </div>
        </div>

       

        <button type="submit"
            class="cursor-pointer bg-blue-700 w-full sm:max-w-[300px] text-white py-2 rounded-lg  text-lg transition-all duration-300 hover:bg-blue-800 flex items-center justify-center mt-6">

            <!-- SVG Icon -->
            <svg class="h-5 w-5 text-slate-50 mr-2" width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" />
                <path d="M6 4h10l4 4v10a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2" />
                <circle cx="12" cy="14" r="2" />
                <polyline points="14 4 14 8 8 8 8 4" />
            </svg>

            Save Changes
        </button>

    </form>
</main>

<script>
document.getElementById('page_toggle').addEventListener('change', function() {
    this.value = this.checked ? 1 : 0;
});
document.getElementById('group_toggle').addEventListener('change', function() {
    this.value = this.checked ? 1 : 0;
});
</script>
@endsection