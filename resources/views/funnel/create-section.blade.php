@extends('layouts.users')

@section('title', 'Create Who I Am Section')

@section('content')
<div class="container mx-auto p-6">
    <div class="flex flex-col lg:flex-row gap-8">

        {{-- Left Column: Form --}}
        <div class="lg:w-[600px]">
            <p class="bg-yellow-100 text-yellow-800 text-base md:text-lg p-4 rounded-md border-l-4 border-yellow-400 mb-6">
                The content you add here will appear on your landing page as the “Who You Are” section. Share your story, your expertise, and what makes you unique.
            </p>

            <form id="whoIamForm" enctype="multipart/form-data" class="space-y-4">
                @csrf
                <input type="hidden" name="section_id" id="section_id">

                <x-input-text name="name" label="Name" placeholder="Enter your name" required />
                <x-input-text name="hook" label="Hook" placeholder="Your hook text" textarea="true" required />
                <x-input-text name="intro" label="Intro Paragraph" placeholder="Enter intro" textarea="true" required />
                <x-input-text name="transition" label="Transition Paragraph" placeholder="Enter transition text" textarea="true" required />

                <label class="block text-gray-700 font-medium mb-1">
                    Bullets <span class="text-red-500 text-xs ml-2">Press Enter for the next bullet</span>
                </label>
                <div id="bulletsContainer" class="space-y-2">
                    <input type="text" name="bullets[]" class="border rounded-md p-2 w-full" placeholder="Type a bullet and press Enter">
                </div>

                <x-input-text name="motivation" label="Motivation" placeholder="Enter motivation" textarea="true" required />
                <x-input-text name="testimonial" label="Testimonial (optional)" placeholder="Enter testimonial" textarea="true" />

                <div class="mb-4">
                    <label for="file" class="text-gray-600 font-medium block mb-1">Upload Image</label>
                    <div id="uploadBox" class="border-2 border-dashed border-gray-300 rounded-xl p-6 text-center bg-gray-50 hover:border-green-400 transition cursor-pointer">
                        <input type="file" name="image" id="file" class="hidden" accept=".jpg,.jpeg,.png">
                        <label for="file" class="flex flex-col items-center justify-center text-gray-500 cursor-pointer">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-12 h-12 text-gray-400 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                      d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6h.1a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
                            </svg>
                            <p class="mb-1">Click to upload or drag image here</p>
                            <small class="text-gray-400">Only JPG or PNG (max 2MB)</small>
                        </label>
                        <p id="filePath" class="mt-2 text-blue-600 text-sm font-semibold"></p>
                    </div>
                </div>

                <div class="flex gap-2">
                    <button type="submit" class="bg-teal-600 hover:bg-teal-700 text-white px-4 py-2 rounded-md">Save Details</button>
                    <button type="button" id="fillSample" class="bg-blue-600 hover:bg-blue-700 text-gray-50 px-4 py-2 rounded-md">Fill Sample</button>
                    <button type="button" id="clearForm" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-md">Clear</button>
                </div>

            </form>
        </div>

        {{-- Right Column: Existing Sections --}}
        <div class="lg:w-full space-y-6">
            <h2 class="text-xl font-bold mb-4">Existing Sections</h2>

            @foreach($sections as $section)
                <section class="border rounded-lg p-4 bg-gray-50 shadow-sm flex flex-col md:flex-row items-center gap-4">

                    <!-- Image -->
                    <div class="md:w-[300px]  flex justify-center ">
                        @if($section->image_path)
                            <img src="{{ asset('storage/' . $section->image_path) }}" 
                                alt="{{ $section->name }}" 
                                class="w-32 md:w-40 object-cover rounded-md">
                        @endif
                    </div>

                    <!-- Text Content -->
                    <div class="md:w-2/3 text-center md:text-left space-y-4">

                        <!-- Hook -->
                        <p class="text-teal-600 font-semibold text-sm md:text-base">
                            {!! $section->hook !!}
                        </p>

                        <!-- Name -->
                        <h3 class="text-lg md:text-xl font-bold text-gray-800">
                            I’m <span class="text-teal-600">{{ $section->name }}</span>
                        </h3>

                        <!-- Intro -->
                        @if($section->intro)
                            <p class="text-gray-700 text-sm leading-snug">
                                {!! $section->intro !!}
                            </p>
                        @endif

                        <!-- Transition -->
                        @if($section->transition)
                            <p class="text-gray-700 text-sm leading-snug">
                                {!! $section->transition !!}
                            </p>
                        @endif

                        <!-- Bullets -->
                        @if(!empty($section->bullets))
                            <ul class="text-gray-700 text-sm leading-snug list-disc list-inside space-y-0.5">
                                @foreach($section->bullets as $bullet)
                                    <li>{!! $bullet !!}</li>
                                @endforeach
                            </ul>
                        @endif

                        <!-- Motivation -->
                        @if($section->motivation)
                            <p class="text-gray-700 text-sm font-semibold mt-1">
                                {!! $section->motivation !!}
                            </p>
                        @endif

                        <!-- Testimonial -->
                        @if($section->testimonial)
                            <p class="mt-1 text-gray-600 italic text-sm">
                                {!! $section->testimonial !!}
                            </p>
                        @endif

                        <!-- Actions -->
                        <div class="mt-2 flex gap-2 justify-center md:justify-start">
                            <button class="bg-yellow-500 text-white px-3 py-1 rounded-sm text-sm updateBtn" data-id="{{ $section->id }}">
                                Update
                            </button>
                            <button class="bg-red-500 text-white px-3 py-1 rounded-sm text-sm deleteBtn" data-id="{{ $section->id }}">
                                Delete
                            </button>
                        </div>

                    </div>
                </section>
            @endforeach
        </div>


    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
$(document).ready(function(){

    $('#file').on('change', function() {
        const file = this.files[0];
        $('#filePath').text(file ? file.name : '');
    });

    $('#bulletsContainer').on('keydown', 'input', function(e){
        if(e.key === 'Enter'){
            e.preventDefault();
            if(this.value.trim() === '') return;
            $('#bulletsContainer').append('<input type="text" name="bullets[]" class="border rounded-md p-2 w-full" placeholder="Type a bullet and press Enter">');
        }
    });

    // Submit form (create/update)
    $('#whoIamForm').on('submit', function(e){
        e.preventDefault();
        let formData = new FormData(this);
        let route = $('#section_id').val() ? "{{ route('funnel.whoiam.update') }}" : "{{ route('funnel.whoiam.store') }}";

        $.ajax({
            url: route,
            method: "POST",
            data: formData,
            processData: false,
            contentType: false,
            success: function(response){
                Swal.fire({ icon: 'success', title: 'Saved!', text: response.message, timer: 2000, showConfirmButton: false });
                location.reload(); // reload page to show updated list
            },
            error: function(xhr){
                let errors = xhr.responseJSON.errors;
                let errMsg = '';
                $.each(errors, function(k,v){ errMsg += v[0] + "\n"; });
                Swal.fire({ icon: 'error', title: 'Oops...', text: errMsg });
            }
        });
    });

    // Delete section
    $(document).on('click', '.deleteBtn', function(){
        let id = $(this).data('id');
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning', showCancelButton: true,
            confirmButtonColor: '#3085d6', cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if(result.isConfirmed){
                $.post("{{ route('funnel.whoiam.delete') }}", {_token: '{{ csrf_token() }}', id: id}, function(){
                    Swal.fire('Deleted!', 'Section has been deleted.', 'success');
                    location.reload(); // reload page to show updated list
                });
            }
        });
    });

    // Load section for update
$(document).on('click', '.updateBtn', function(){
    let id = $(this).data('id');
    $.get("{{ url('funnel/whoiam') }}/"+id, function(section){
        $('#section_id').val(section.id);
        $('[name="name"]').val(section.name);
        $('[name="hook"]').val(section.hook);
        $('[name="intro"]').val(section.intro);
        $('[name="transition"]').val(section.transition);
        $('[name="motivation"]').val(section.motivation);
        $('[name="testimonial"]').val(section.testimonial);

        // Clear bullets container
        $('#bulletsContainer').html('');

        // Parse bullets JSON if needed
        let bullets = Array.isArray(section.bullets) ? section.bullets : JSON.parse(section.bullets || '[]');

        bullets.forEach(b => {
            $('#bulletsContainer').append(`<input type="text" name="bullets[]" class="border rounded-md p-2 w-full" value="${b}" placeholder="Type a bullet and press Enter">`);
        });

        // Optional: preview existing image if any
        if(section.image_path){
            $('#filePath').text(section.image_path.split('/').pop());
        } else {
            $('#filePath').text('');
        }

        // Scroll to form
        $('html, body').animate({ scrollTop: $('#whoIamForm').offset().top }, 500);
    });
});


    // Sample data autofill
    const sampleData = {
        name: "May Fullon Balisnomo",
        hook: "From healthcare professional to earning ₱58,000 in a single day online!",
        intro: "With 18 years of experience in the healthcare industry in the United Kingdom, caring for others has always been my passion. My career in healthcare has been both fulfilling and rewarding.",
        transition: "Beyond my profession, I took a leap into the world of digital entrepreneurship—something I never imagined myself doing. As someone who wasn’t tech-savvy, I had doubts at first, but with the guidance of mentors and a supportive community, I quickly learned and thrived.",
        bullets: [
            "Transformed curiosity into a life-changing opportunity",
            "Achieved financial milestones I never thought possible",
            "Earned as much as ₱58,000 in a single day",
            "Inspiring friends and peers to join this venture"
        ],
        motivation: "My goal is to help more individuals realise that even a simple individual like me can level up their income by seizing this business opportunity. If I can do it, so can you!",
        testimonial: '"I saw May’s success and knew I could do it too—now I’m earning consistently online!" – Maria, Fellow Entrepreneur'
    };

    $('#fillSample').on('click', function() {
        $('#section_id').val(''); // clear any update ID
        $('[name="name"]').val(sampleData.name);
        $('[name="hook"]').val(sampleData.hook);
        $('[name="intro"]').val(sampleData.intro);
        $('[name="transition"]').val(sampleData.transition);
        $('[name="motivation"]').val(sampleData.motivation);
        $('[name="testimonial"]').val(sampleData.testimonial);

        $('#bulletsContainer').html('');
        sampleData.bullets.forEach(bullet => {
            const input = $('<input>')
                .attr('type', 'text')
                .attr('name', 'bullets[]')
                .attr('placeholder', 'Type a bullet and press Enter')
                .addClass('border rounded-md p-2 w-full')
                .val(bullet);
            $('#bulletsContainer').append(input);
        });
    });

    $('#clearForm').on('click', function() {
    // Clear all input fields
    $('#whoIamForm')[0].reset();

    // Clear hidden section_id
    $('#section_id').val('');

    // Clear bullets container
    $('#bulletsContainer').html('<input type="text" name="bullets[]" class="border rounded-md p-2 w-full" placeholder="Type a bullet and press Enter">');

    // Clear file path text
    $('#filePath').text('');
});


});
</script>
@endsection
