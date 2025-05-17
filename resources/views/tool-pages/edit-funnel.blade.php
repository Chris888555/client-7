@extends('layouts.app')

@section('title', 'Edit Sales Funnel ')

@section('content')



<div class="container m-auto p-4 sm:p-8 max-w-full">

    <x-page-header-text 
    title="Edit Funnel Page"
    subtitle="Easily manage and customize the content of your funnel page to suit your
        needs and preferences"
/>



    <form method="POST" action="{{ route('update.funnel') }}" enctype="multipart/form-data">
        @csrf
  
    <div class="mb-4 border-2 border-gray-300 p-6 rounded-lg ">
        <div class="mb-4">
            <label for="page_link_1" class="block text-sm font-medium text-gray-700">Page Link</label>
            <input type="text" id="page_link_1" name="page_link_1"
                class="w-full border border-gray-300 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                value="{{ old('page_link_1', $funnel->page_link_1 ?? '') }}" oninput="validatePageLink(this)">
            <!-- Error message container -->
            <p id="page_link_1_error" class="text-sm mt-1 text-red-500 hidden">Only letters, numbers, and dashes (-) are
                allowed.</p>
        </div>

        <script>
        function validatePageLink(input) {
            // Get the error message element
            const errorMessage = document.getElementById('page_link_1_error');

            // Regex to allow letters, numbers, and hyphens
            const regex = /^[a-zA-Z0-9-]*$/;

            // Check if input value matches the regex pattern
            if (!regex.test(input.value)) {
                errorMessage.classList.remove('hidden'); // Show the error message
            } else {
                errorMessage.classList.add('hidden'); // Hide the error message
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
        </div>


        <!-- Video Link -->
         <div class="mb-4 border-2 border-gray-300 p-6 rounded-lg ">
        <div class="mb-4">
            <label for="video_link" class="block text-sm font-medium text-gray-700">Video Link / Youtube or MP4</label>
            <input type="text" id="video_link" name="video_link"
                class="w-full border border-gray-300 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                value="{{ old('video_link', $funnelContent['video_link'] ?? '') }}">
        </div>

        <!-- Video Thumbnail -->
        <div class="mb-4">
            <label for="video_thumbnail" class="block text-sm font-medium text-gray-700">Mp4 Video Thumbnail</label>
            <input type="file" name="video_thumbnail" id="video_thumbnail"
                class="w-full border border-gray-300 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                accept="image/*">
        </div>
         </div>

         <div class="mb-4 border-2 border-gray-300 p-6 rounded-lg ">
        <div class="flex-1 mb-4">
            <label for="intro_headline" class="block text-sm font-medium text-gray-700">Intro Headline</label>
            <input type="text" id="intro_headline" name="intro_headline"
                class="w-full border border-gray-300 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                value="{{ old('intro_headline', is_array($funnelContent['intro_headline'] ?? '') ? implode(', ', $funnelContent['intro_headline']) : $funnelContent['intro_headline'] ?? '') }}">
        </div>

        <div class="flex-1 mb-4">
            <label for="intro_paragraph" class="block text-sm font-medium text-gray-700">Intro Paragraph</label>
            <input type="text" id="intro_paragraph" name="intro_paragraph"
                class="w-full border border-gray-300 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                value="{{ old('intro_paragraph', is_array($funnelContent['intro_paragraph'] ?? '') ? implode(', ', $funnelContent['intro_paragraph']) : $funnelContent['intro_paragraph'] ?? '') }}">
        </div>

        <div class="flex-1 mb-4">
            <label for="benefits_title" class="block text-sm font-medium text-gray-700">Benefits Title</label>
            <input type="text" id="benefits_title" name="benefits_title"
                class="w-full border border-gray-300 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                value="{{ old('benefits_title', is_array($funnelContent['benefits_title'] ?? '') ? implode(', ', $funnelContent['benefits_title']) : $funnelContent['benefits_title'] ?? '') }}">
        </div>

       @php
    $benefitsListRaw = $funnelContent['benefits_list'] ?? '';
    $benefitsList = is_array($benefitsListRaw) ? implode("\n", $benefitsListRaw) : str_replace(',', "\n", $benefitsListRaw);
@endphp

<div class="mb-4">
    <label for="benefits_input" class="block text-sm font-medium text-gray-700">Benefits List</label>
    <div id="benefits_wrapper" class="flex flex-wrap gap-2 p-2 border border-gray-300 rounded-md min-h-[48px]">
        <!-- Tags will appear here -->
        <input type="text" id="benefits_input" class="flex-1 outline-none" placeholder="Type benefit then press Enter">
    </div>
    <input type="hidden" name="benefits_list" id="benefits_hidden">
</div>
<script>
    const input = document.getElementById('benefits_input');
    const wrapper = document.getElementById('benefits_wrapper');
    const hidden = document.getElementById('benefits_hidden');
    let benefits = [];

    // Auto-load existing benefits from server (from Laravel Blade)
    const oldBenefits = {!! json_encode(
        old('benefits_list')
            ? explode(',', old('benefits_list'))
            : (isset($funnelContent['benefits_list']) 
                ? (is_array($funnelContent['benefits_list']) 
                    ? $funnelContent['benefits_list'] 
                    : explode(',', $funnelContent['benefits_list'])) 
                : [])
    ) !!};

    window.addEventListener('DOMContentLoaded', () => {
        oldBenefits.forEach(item => {
            const trimmed = item.trim();
            if (trimmed !== '') {
                addBenefit(trimmed);
            }
        });
    });

    input.addEventListener('keydown', function (e) {
        if (e.key === 'Enter' && this.value.trim() !== '') {
            e.preventDefault();
            addBenefit(this.value.trim());
            this.value = '';
        }
    });

    function addBenefit(text) {
        // Prevent duplicates
        if (benefits.includes(text)) return;

        benefits.push(text);
        updateHiddenInput();

        const tag = document.createElement('span');
        tag.className = 'bg-blue-100 text-blue-700 px-2 py-1 rounded-full flex items-center space-x-1';
        tag.innerHTML = `
            <span>${text}</span>
            <button type="button" class="ml-1 text-sm text-red-500 font-bold">&times;</button>
        `;

        tag.querySelector('button').addEventListener('click', () => {
            wrapper.removeChild(tag);
            benefits = benefits.filter(b => b !== text);
            updateHiddenInput();
        });

        wrapper.insertBefore(tag, input);
    }

    function updateHiddenInput() {
        hidden.value = benefits.join(',');
    }
</script>  
  </div>

        <!-- Testimonial Headline & Subheadline -->
         <div class="mb-4 border-2 border-gray-300 p-6 rounded-lg ">
        <div class="flex flex-col md:flex-row gap-4 mb-4">
            <div class="flex-1">
                <label for="testimonial_headline" class="block text-sm font-medium text-gray-700">Testimonial
                    Headline</label>
                <input type="text" id="testimonial_headline" name="testimonial_headline"
                    class="w-full border border-gray-300 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                    value="{{ old('testimonial_headline', $funnelContent['testimonial_headline'] ?? '') }}">
            </div>
            <div class="flex-1">
                <label for="testimonial_subheadline" class="block text-sm font-medium text-gray-700">Testimonial
                    Subheadline</label>
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
                    value="{{ old('fomo_hours', $funnelContent['fomo_countdown']['hours'] ?? '') }}"
                    placeholder="Hours">
                <input type="number" name="fomo_minutes"
                    class="w-full sm:w-1/3 border border-gray-300 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                    value="{{ old('fomo_minutes', $funnelContent['fomo_countdown']['minutes'] ?? '') }}"
                    placeholder="Minutes">
            </div>
        </div>
  </div>

        <!-- Referral Link -->
          <div class="flex flex-col mb-4 border-2 border-gray-300 p-6 rounded-lg">
            <div class="flex flex-col md:flex-row gap-4">
        <div class="mb-4">
            <label for="Referral_link" class="block text-sm font-medium text-gray-700">Referral Link</label>
            <input type="text" id="Referral_link" name="Referral_link"
                class="w-full border border-gray-300 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                value="{{ old('Referral_link', $funnelContent['Referral_link'] ?? '') }}">
            <input type="checkbox" name="Referral_link_toggle" class="ml-2"
                {{ old('Referral_link_toggle', $funnelContent['Referral_link_toggle'] ?? false) ? 'checked' : '' }}>
            Show Referral Link
        </div>

        <div class="flex-1 mb-4">
            <label for="Referral_button_text" class="block text-sm font-medium text-gray-700">Referral Button
                Text</label>
            <input type="text" id="Referral_button_text" name="Referral_button_text"
                class="w-full border border-gray-300 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                value="{{ old('Referral_button_text', is_array($funnelContent['Referral_button_text'] ?? '') ? implode(', ', $funnelContent['Referral_button_text']) : $funnelContent['Referral_button_text'] ?? '') }}">
        </div>

        <div class="flex-1 mb-4">
            <label for="Referral_button_subtext" class="block text-sm font-medium text-gray-700">Referral Button
                Subtext</label>
            <input type="text" id="Referral_button_subtext" name="Referral_button_subtext"
                class="w-full border border-gray-300 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                value="{{ old('Referral_button_subtext', is_array($funnelContent['Referral_button_subtext'] ?? '') ? implode(', ', $funnelContent['Referral_button_subtext']) : $funnelContent['Referral_button_subtext'] ?? '') }}">
            </div>
        </div>
  </div>


        <!-- Group Chat Link -->
           <div class="flex flex-col mb-4 border-2 border-gray-300 p-6 rounded-lg">
            <div class="flex flex-col md:flex-row gap-4">
        <div class="mb-4">
            <label for="Group_chat_link" class="block text-sm font-medium text-gray-700">Group Chat Link</label>
            <input type="text" id="Group_chat_link" name="Group_chat_link"
                class="w-full border border-gray-300 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                value="{{ old('Group_chat_link', $funnelContent['Group_chat_link'] ?? '') }}">
            <input type="checkbox" name="Group_chat_link_toggle" class="ml-2"
                {{ old('Group_chat_link_toggle', $funnelContent['Group_chat_link_toggle'] ?? false) ? 'checked' : '' }}>
            Show Group Chat Link
        </div>

        <div class="flex-1 mb-4">
            <label for="Group_chat_button_text" class="block text-sm font-medium text-gray-700">Group Chat Button
                Text</label>
            <input type="text" id="Group_chat_button_text" name="Group_chat_button_text"
                class="w-full border border-gray-300 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                value="{{ old('Group_chat_button_text', is_array($funnelContent['Group_chat_button_text'] ?? '') ? implode(', ', $funnelContent['Group_chat_button_text']) : $funnelContent['Group_chat_button_text'] ?? '') }}">
        </div>

        <div class="flex-1 mb-4">
            <label for="Group_chat_button_subtext" class="block text-sm font-medium text-gray-700">Group Chat Button
                Subtext</label>
            <input type="text" id="Group_chat_button_subtext" name="Group_chat_button_subtext"
                class="w-full border border-gray-300 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                value="{{ old('Group_chat_button_subtext', is_array($funnelContent['Group_chat_button_subtext'] ?? '') ? implode(', ', $funnelContent['Group_chat_button_subtext']) : $funnelContent['Group_chat_button_subtext'] ?? '') }}">
        </div>
           </div>
              </div>


        <!-- Messenger Link -->
        <div class="mb-4 border-2 border-gray-300 p-6 rounded-lg">
            <label for="Messenger_link" class="block text-sm font-medium text-gray-700">Messenger Link</label>
            <input type="text" id="Messenger_link" name="Messenger_link"
                class="w-full border border-gray-300 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                value="{{ old('Messenger_link', $funnelContent['Messenger_link'] ?? '') }}">
            <input type="checkbox" name="Messenger_link_toggle" class="ml-2"
                {{ old('Messenger_link_toggle', $funnelContent['Messenger_link_toggle'] ?? false) ? 'checked' : '' }}>
            Show Messenger Link
        </div>

        <!-- Submit Button -->
        <div class="mb-4">
            <button type="submit"
                class="w-full bg-blue-500 text-white p-2 rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500">
                Update Content
            </button>
        </div>

    </form>
</div>

@endsection