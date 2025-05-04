@extends('layouts.app')

@section('title', 'Edit Sales Funnel ')

@section('content')

@include('includes.nav')
<div class="container m-auto p-4 sm:p-8 max-w-full">

    <h2 class="text-2xl font-bold mb-6">Edit Funnel</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

   <form method="POST" action="{{ route('update.funnel') }}" enctype="multipart/form-data">
    @csrf

        <div class="mb-4">
            <label for="headline" class="block text-sm font-medium text-gray-700">Headline</label>
            <input type="text" id="headline" name="headline" class="w-full border border-gray-300 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-blue-500" value="{{ old('headline', $funnelData['headline'] ?? '') }}">
        </div>

        <div class="mb-4">
            <label for="subheadline" class="block text-sm font-medium text-gray-700">Subheadline</label>
            <input type="text" id="subheadline" name="subheadline" class="w-full border border-gray-300 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-blue-500" value="{{ old('subheadline', $funnelData['subheadline'] ?? '') }}">
        </div>

        <div class="mb-4">
            <label for="video_link" class="block text-sm font-medium text-gray-700">Video Link</label>
            <input type="text" id="video_link" name="video_link" class="w-full border border-gray-300 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-blue-500" value="{{ old('video_link', $funnelData['video_link'] ?? '') }}">
        </div>

        <!-- Add the Video Thumbnail input field below -->
<div class="mb-4">
    <label for="video_thumbnail" class="block text-sm font-medium text-gray-700">Video Thumbnail</label>
    <input type="file" name="video_thumbnail" id="video_thumbnail" class="w-full border border-gray-300 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-blue-500" accept="image/*">
</div>

        <div class="mb-4">
            <label for="testimonial_headline" class="block text-sm font-medium text-gray-700">Testimonial Headline</label>
            <input type="text" id="testimonial_headline" name="testimonial_headline" class="w-full border border-gray-300 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-blue-500" value="{{ old('testimonial_headline', $funnelData['testimonial_headline'] ?? '') }}">
        </div>

        <div class="mb-4">
            <label for="testimonial_subheadline" class="block text-sm font-medium text-gray-700">Testimonial Subheadline</label>
            <input type="text" id="testimonial_subheadline" name="testimonial_subheadline" class="w-full border border-gray-300 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-blue-500" value="{{ old('testimonial_subheadline', $funnelData['testimonial_subheadline'] ?? '') }}">
        </div>

         <!-- Testimonial Images -->
    <div class="mb-4">
        <label class="block text-sm font-medium text-gray-700">Testimonial Images</label>
        <input type="file" name="testimonial_image_1" class="w-full border border-gray-300 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
        <input type="file" name="testimonial_image_2" class="w-full border border-gray-300 rounded-md p-2 mt-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
        <input type="file" name="testimonial_image_3" class="w-full border border-gray-300 rounded-md p-2 mt-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
    </div>

        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700">Testimonial Videos</label>
            <input type="text" name="testimonial_video_1" class="w-full border border-gray-300 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Video URL 1" value="{{ old('testimonial_video_1', $funnelData['testimonial_video_link'][0] ?? '') }}">
            <input type="text" name="testimonial_video_2" class="w-full border border-gray-300 rounded-md p-2 mt-2 focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Video URL 2" value="{{ old('testimonial_video_2', $funnelData['testimonial_video_link'][1] ?? '') }}">
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700">FOMO Countdown</label>
            <input type="number" name="fomo_days" class="w-full border border-gray-300 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-blue-500" value="{{ old('fomo_days', $funnelData['fomo_countdown']['days'] ?? 0) }}" placeholder="Days">
            <input type="number" name="fomo_hours" class="w-full border border-gray-300 rounded-md p-2 mt-2 focus:outline-none focus:ring-2 focus:ring-blue-500" value="{{ old('fomo_hours', $funnelData['fomo_countdown']['hours'] ?? 0) }}" placeholder="Hours">
            <input type="number" name="fomo_minutes" class="w-full border border-gray-300 rounded-md p-2 mt-2 focus:outline-none focus:ring-2 focus:ring-blue-500" value="{{ old('fomo_minutes', $funnelData['fomo_countdown']['minutes'] ?? 0) }}" placeholder="Minutes">
        </div>

        <div class="mb-4">
            <label for="Messenger_link" class="block text-sm font-medium text-gray-700">Messenger Link</label>
            <input type="text" id="Messenger_link" name="Messenger_link" class="w-full border border-gray-300 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-blue-500" value="{{ old('Messenger_link', $funnelData['Messenger_link'] ?? '') }}">
            <input type="checkbox" name="Messenger_link_toggle" class="ml-2" {{ old('Messenger_link_toggle', $funnelData['Messenger_link_toggle'] ?? false) ? 'checked' : '' }}> Show Messenger Link
        </div>

        <div class="mb-4">
            <label for="Referral_link" class="block text-sm font-medium text-gray-700">Referral Link</label>
            <input type="text" id="Referral_link" name="Referral_link" class="w-full border border-gray-300 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-blue-500" value="{{ old('Referral_link', $funnelData['Referral_link'] ?? '') }}">
            <input type="checkbox" name="Referral_link_toggle" class="ml-2" {{ old('Referral_link_toggle', $funnelData['Referral_link_toggle'] ?? false) ? 'checked' : '' }}> Show Referral Link
        </div>

        <div class="mb-4">
            <label for="Group_chat_link" class="block text-sm font-medium text-gray-700">Group Chat Link</label>
            <input type="text" id="Group_chat_link" name="Group_chat_link" class="w-full border border-gray-300 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-blue-500" value="{{ old('Group_chat_link', $funnelData['Group_chat_link'] ?? '') }}">
            <input type="checkbox" name="Group_chat_link_toggle" class="ml-2" {{ old('Group_chat_link_toggle', $funnelData['Group_chat_link_toggle'] ?? false) ? 'checked' : '' }}> Show Group Chat Link
        </div>

        <button type="submit" class="w-full bg-blue-500 text-white p-2 rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500">Update Funnel</button>
    </form>
</div>
@endsection
