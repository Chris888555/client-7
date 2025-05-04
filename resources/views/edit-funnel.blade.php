@extends('layouts.app')

@section('title', 'Edit Sales Funnel ')

@section('content')

@include('includes.nav')

<div class="container m-auto p-4 sm:p-8 max-w-full">

    <h2 class="text-2xl font-bold mb-6">Edit Funnel</h2>

    @if(session('success'))
    <div class="alert alert-success mb-4">{{ session('success') }}</div>
    @endif

    <form method="POST" action="{{ route('update.funnel') }}" enctype="multipart/form-data">
        @csrf

    <div class="mb-4">
    <label for="page_link_1" class="block text-sm font-medium text-gray-700">Page Link</label>
    <input type="text" id="page_link_1" name="page_link_1"
        class="w-full border border-gray-300 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
        value="{{ old('page_link_1', $funnel->page_link_1 ?? '') }}"
        oninput="validatePageLink(this)">
    <!-- Error message container -->
    <p id="page_link_1_error" class="text-sm mt-1 text-red-500 hidden">Only letters, numbers, and dashes (-) are allowed.</p>
</div>

<script>
    function validatePageLink(input) {
        // Get the error message element
        const errorMessage = document.getElementById('page_link_1_error');

        // Regex to allow letters, numbers, and hyphens
        const regex = /^[a-zA-Z0-9-]*$/;

        // Check if input value matches the regex pattern
        if (!regex.test(input.value)) {
            errorMessage.classList.remove('hidden');  // Show the error message
        } else {
            errorMessage.classList.add('hidden');  // Hide the error message
        }
    }
</script>

 @error('page_link_1')
        <p class="text-sm mb-2 mt-0 text-red-500">{{ $message }}</p>
    @enderror

        <!-- Headline & Subheadline -->
        <div class="flex flex-col md:flex-row gap-4 mb-4">
            <div class="flex-1">
                <label for="headline" class="block text-sm font-medium text-gray-700">Headline</label>
                <input type="text" id="headline" name="headline"
                    class="w-full border border-gray-300 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                    value="{{ old('headline', $funnelContent['headline'] ?? '') }}">
            </div>
            <div class="flex-1">
                <label for="subheadline" class="block text-sm font-medium text-gray-700">Subheadline</label>
                <input type="text" id="subheadline" name="subheadline"
                    class="w-full border border-gray-300 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                    value="{{ old('subheadline', $funnelContent['subheadline'] ?? '') }}">
            </div>
        </div>

        <!-- Video Link -->
        <div class="mb-4">
            <label for="video_link" class="block text-sm font-medium text-gray-700">Video Link</label>
            <input type="text" id="video_link" name="video_link"
                class="w-full border border-gray-300 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                value="{{ old('video_link', $funnelContent['video_link'] ?? '') }}">
        </div>

        <!-- Video Thumbnail -->
        <div class="mb-4">
            <label for="video_thumbnail" class="block text-sm font-medium text-gray-700">Video Thumbnail</label>
            <input type="file" name="video_thumbnail" id="video_thumbnail"
                class="w-full border border-gray-300 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                accept="image/*">
        </div>

        <!-- Testimonial Headline & Subheadline -->
        <div class="flex flex-col md:flex-row gap-4 mb-4">
            <div class="flex-1">
                <label for="testimonial_headline" class="block text-sm font-medium text-gray-700">Testimonial Headline</label>
                <input type="text" id="testimonial_headline" name="testimonial_headline"
                    class="w-full border border-gray-300 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                    value="{{ old('testimonial_headline', $funnelContent['testimonial_headline'] ?? '') }}">
            </div>
            <div class="flex-1">
                <label for="testimonial_subheadline" class="block text-sm font-medium text-gray-700">Testimonial Subheadline</label>
                <input type="text" id="testimonial_subheadline" name="testimonial_subheadline"
                    class="w-full border border-gray-300 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                    value="{{ old('testimonial_subheadline', $funnelContent['testimonial_subheadline'] ?? '') }}">
            </div>
        </div>

        <!-- Testimonial Images -->
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700">Testimonial Images</label>
            <input type="file" name="testimonial_images[]"
                class="w-full border border-gray-300 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                multiple>
        </div>

        <!-- FOMO Countdown -->
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700">FOMO Countdown</label>
            <div class="flex flex-col sm:flex-row gap-2">
                <input type="number" name="fomo_days"
                    class="w-full sm:w-1/3 border border-gray-300 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                    value="{{ old('fomo_days', $funnelContent['fomo_countdown']['days'] ?? '') }}" placeholder="Days">
                <input type="number" name="fomo_hours"
                    class="w-full sm:w-1/3 border border-gray-300 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                    value="{{ old('fomo_hours', $funnelContent['fomo_countdown']['hours'] ?? '') }}" placeholder="Hours">
                <input type="number" name="fomo_minutes"
                    class="w-full sm:w-1/3 border border-gray-300 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                    value="{{ old('fomo_minutes', $funnelContent['fomo_countdown']['minutes'] ?? '') }}" placeholder="Minutes">
            </div>
        </div>

        <!-- Referral Link -->
        <div class="mb-4">
            <label for="Referral_link" class="block text-sm font-medium text-gray-700">Referral Link</label>
            <input type="text" id="Referral_link" name="Referral_link"
                class="w-full border border-gray-300 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                value="{{ old('Referral_link', $funnelContent['Referral_link'] ?? '') }}">
            <input type="checkbox" name="Referral_link_toggle" class="ml-2"
                {{ old('Referral_link_toggle', $funnelContent['Referral_link_toggle'] ?? false) ? 'checked' : '' }}>
            Show Referral Link
        </div>

        <!-- Messenger Link -->
        <div class="mb-4">
            <label for="Messenger_link" class="block text-sm font-medium text-gray-700">Messenger Link</label>
            <input type="text" id="Messenger_link" name="Messenger_link"
                class="w-full border border-gray-300 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                value="{{ old('Messenger_link', $funnelContent['Messenger_link'] ?? '') }}">
            <input type="checkbox" name="Messenger_link_toggle" class="ml-2"
                {{ old('Messenger_link_toggle', $funnelContent['Messenger_link_toggle'] ?? false) ? 'checked' : '' }}>
            Show Messenger Link
        </div>

        <!-- Group Chat Link -->
        <div class="mb-4">
            <label for="Group_chat_link" class="block text-sm font-medium text-gray-700">Group Chat Link</label>
            <input type="text" id="Group_chat_link" name="Group_chat_link"
                class="w-full border border-gray-300 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                value="{{ old('Group_chat_link', $funnelContent['Group_chat_link'] ?? '') }}">
            <input type="checkbox" name="Group_chat_link_toggle" class="ml-2"
                {{ old('Group_chat_link_toggle', $funnelContent['Group_chat_link_toggle'] ?? false) ? 'checked' : '' }}>
            Show Group Chat Link
        </div>

        <!-- Submit Button -->
        <div class="mb-4">
            <button type="submit"
                class="w-full bg-blue-500 text-white p-2 rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500">
                Update Funnel
            </button>
        </div>

    </form>
</div>

@endsection
