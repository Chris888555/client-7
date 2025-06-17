@extends('layouts.admin')

@section('title', 'Manage Funnel ')

@section('content')
<div class="container m-auto p-4 sm:p-8 max-w-full">
   
      <x-page-header-text title="Manage funnel to all users" />

       <div class="flex items-center justify-center max-w-[350px] mx-auto p-2 bg-gray-50 rounded-2xl border gap-2">
        <a href="{{ route('list.showtable') }}"
            class="w-full text-center hover:bg-gray-100 text-gray-800 px-5 py-2 rounded-xl  transition cursor-pointer">
        Users List
        </a>

        <a href="{{ route('manage.showtable') }}"
            class="w-full text-center hover:bg-gray-100 bg-gray-100 text-teal-600 px-5 py-2 rounded-xl transition cursor-pointer">
            Funnel Blocks
        </a>
    </div>

<div class="mt-6 mb-8 rounded-2xl border-l-[6px] border-orange-500 bg-orange-50 p-5 shadow">
  <div class="flex items-start space-x-4">
    <div class="text-orange-500">
      <!-- Heroicon warning -->
      <svg class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="2"
           viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
        <path stroke-linecap="round" stroke-linejoin="round"
              d="M12 9v2m0 4h.01M4.93 19h14.14c1.18 0 2.07-1.14 1.7-2.27L13.7 4.27a1.75 1.75 0 00-3.4 0L3.23 16.73A1.75 1.75 0 004.93 19z">
        </path>
      </svg>
    </div>
    <div>
      <h3 class="text-lg font-semibold text-orange-800">Warning</h3>
      <p class="mt-1 text-sm text-orange-700">
        Any changes made here will be applied to <span class="font-medium">all users</span>. Please proceed with caution.
      </p>
    </div>
  </div>
</div>

    {{-- Table Wrapper --}}
    <div id="blockTable" class="overflow-x-auto bg-white rounded-xl shadow-sm border">
        <table class="min-w-full divide-y divide-gray-200 whitespace-nowrap">
            <thead class="bg-gray-100 ">
                <tr>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-600 uppercase">Block Name</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-600 uppercase">Sort Order</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-600 uppercase">Is Active</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-600 uppercase">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($funnel->blocks->sortBy('sort_order') as $block)
                <tr class="border-t">
                    <td class="px-4 py-3 text-sm text-left">{{ $block->block_name }}</td>
                    <td class="px-4 py-3 text-sm text-left">
                        <form id="sortOrderForm-{{ $block->id }}" action="{{ route('manage.blocks.updateSortOrder', $block->id) }}" method="POST" class="inline sort-order-form">
                            @csrf
                            @method('POST')
                            <input type="number" name="sort_order" value="{{ $block->sort_order }}" class="w-20 px-2 py-1 border rounded text-center" />
                            <button type="submit" class="ml-2 text-blue-600 hover:text-blue-800">
                                <i class="fa-solid fa-floppy-disk"></i>
                            </button>
                        </form>
                    </td>

                    <td class="px-4 py-3 text-sm text-left">{{ $block->is_active ? 'Yes' : 'No' }}</td>
                    <td class="px-4 py-3 text-sm text-left">
                        <div class="flex items-center gap-2">
                        <button
                            class="edit-btn text-gray-700 bg-gray-100 hover:bg-gray-200 px-4 py-2 rounded-lg text-sm border shadow-sm transition duration-300 ease-in-out"
                            data-id="{{ $block->id }}" data-block_name="{{ $block->block_name }}"
                            data-content='@json(json_decode($block->content))'>
                            <i class="fa-solid fa-pen-to-square"></i> Edit
                        </button>

                    <form method="POST" id="toggle-active-form-{{ $block->id }}" data-id="{{ $block->id }}">
                        @csrf
                        <button type="submit"
                        class="toggle-active-btn bg-gray-100 px-4 py-2 rounded-lg text-sm border shadow-sm transition duration-300 ease-in-out
                            {{ $block->is_active ? 'text-green-600 hover:text-green-700' : 'text-red-600 hover:text-red-700' }}">
                        {{ $block->is_active ? 'Deactivate' : 'Activate' }}
                        </button>
                        </div>
                    </form>


                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>


    <div id="editFormWrapper" class="hidden mt-6 bg-white p-6 rounded-xl shadow border">
        <form id="editBlockForm" class="space-y-6">
            @csrf
            <input type="hidden" name="block_id" id="block_id">
            <input type="hidden" name="block_name" id="block_name">

            {{-- Hero Block --}}
            <div class="block-form space-y-4" id="form-hero" style="display: none;">
                <x-input-text id="hero_headline" name="headline" label="Headline" />
                <x-input-text id="hero_subheadline" name="subheadline" label="Subheadline" />
                <x-input-text id="hero_video_url" name="video_url" label="Video URL" />
                <div class="">
                    <label for="video_thumbnail" class="block text-sm font-semibold text-gray-600 mb-2">
                        Video Thumbnail
                        <span class="text-red-500 text-xs font-normal ml-1">
                            (Leave this input if you don't want to change the thumbnail)
                        </span>
                    </label>


                    <input type="file" name="video_thumbnail" id="video_thumbnail"
                        accept="image/*"
                        class="block w-full px-2 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-gray-200">

                    @if(isset($content['video_thumbnail']))
                        <input type="hidden" name="old_thumbnail" value="{{ $content['video_thumbnail'] }}">
                        <div class="mt-2">
                            <img src="{{ asset('storage/' . $content['video_thumbnail']) }}" alt="Current Thumbnail"
                                class="w-32 h-20 object-cover rounded-lg border border-gray-300 shadow">
                        </div>
                    @endif
                </div>


                <x-input-text id="hero_cta_text" name="cta_text" label="CTA Text" />
                <x-input-text id="hero_cta_link" name="cta_link" label="CTA Link" />
            </div>

            {{-- Countdown Block --}}
            <div class="block-form" id="form-countdown" style="display: none;">
                <x-input-text id="countdown_title" name="title" label="Countdown Title" />
                <x-input-text id="countdown_subtitle" name="subtitle" label="Countdown Subtitle" />
                <x-input-text id="countdown_days" name="days" label="Days" type="number" />
                <x-input-text id="countdown_hours" name="hours" label="Hours" type="number" />
                <x-input-text id="countdown_minutes" name="minutes" label="Minutes" type="number" />
                <x-input-text id="countdown_seconds" name="seconds" label="Seconds" type="number" />
            </div>

            {{-- Features Block --}}
            <div class="block-form" id="form-features" style="display: none;">
                <x-input-text id="features_title" name="title" label="Section Title" />
                
                <div id="features_items_wrapper" class="mt-4 space-y-2">
                    {{-- JS will populate feature items here --}}
                </div>

                <button type="button" id="add_feature_item_btn" class="mt-2 px-4 py-1 bg-green-200 text-gray-600 rounded flex items-center gap-2">
                    <i class="fas fa-plus"></i>
                    Add Feature Item
                </button>
            </div>

            {{-- Testimonials Block --}}
            <div class="block-form" id="form-testimonials" style="display: none;">
                <x-input-text id="testimonials_title" name="title" label="Section Title" />

                <div id="testimonials_items_wrapper" class="mt-4 space-y-2">
                    {{-- JS will populate testimonial items here --}}
                </div>

                <button type="button" id="add_testimonial_btn" class="mt-2 px-4 py-1 bg-green-200 text-gray-600 rounded flex items-center gap-2">
                    <i class="fas fa-plus"></i>
                    Add Testimonial
                </button>
            </div>

            {{-- FAQ Block --}}
            <div class="block-form" id="form-faq" style="display: none;">
                <x-input-text id="faq_title" name="title" label="Section Title" />

                <div id="faq_items_wrapper" class="mt-4 space-y-2">
                    {{-- JS will populate FAQ items here --}}
                </div>

                <button type="button" id="add_faq_btn" class="mt-2 px-4 py-1 bg-green-200 text-gray-600 rounded flex items-center gap-2">
                    <i class="fas fa-plus"></i>
                    Add FAQ Item
                </button>
            </div>


            {{-- Messenger Button Block --}}
            <div class="block-form" id="form-messengerbtn" style="display: none;">
                <x-input-text id="messenger_btn_text" name="btn_text" label="Button Text" />
                <x-input-text id="messenger_btn_link" name="btn_link" label="Messenger Link URL" />
            </div>

            {{-- Footer Block --}}
            <div class="block-form" id="form-footer" style="display: none;">
                <x-input-text id="footer_text" name="text" label="Footer Text" />
                <x-input-text id="footer_disclaimer" name="disclaimer" label="Disclaimer" rows="5" />
            </div>


            <div class="flex gap-2 mt-4">
                <button type="submit" class="bg-blue-100 text-blue-700 px-4 py-2 rounded hover:bg-blue-200">
                    <i class="fas fa-save mr-2"></i> Update
                </button>
                <button type="button" id="cancelEdit"
                    class="bg-red-100 text-gray-700 px-4 py-2 rounded hover:bg-red-200 ml-2">
                    <i class="fa-solid fa-xmark mr-1"></i> Cancel
                </button>
            </div>
        </form>
    </div>



 <script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('editBlockForm');

    // AJAX submit
    if (form) {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            const formData = new FormData(form);

            fetch('{{ route("manage.blocks.update") }}', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value,
                    },
                    body: formData
                })
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Updated',
                            text: data.message
                        }).then(() => location.reload());
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: data.message || 'Something went wrong.'
                        });
                    }
                })
                .catch(error => {
                    Swal.fire({
                        icon: 'error',
                        title: 'AJAX Error',
                        text: error.message
                    });
                });
        });
    }

    // Cancel Edit
    document.getElementById('cancelEdit').addEventListener('click', function() {
        document.getElementById('editFormWrapper').classList.add('hidden');
        document.getElementById('blockTable').classList.remove('hidden');
        document.querySelectorAll('.block-form').forEach(form => form.style.display = 'none');
    });

    // Edit Button Click
    document.querySelectorAll('.edit-btn').forEach(button => {
        button.addEventListener('click', function() {
            const blockId = this.dataset.id;
            const blockName = this.dataset.block_name;
            const content = JSON.parse(this.dataset.content || '{}');

            document.getElementById('block_id').value = blockId;
            document.getElementById('block_name').value = blockName;

            document.getElementById('blockTable').classList.add('hidden');
            document.getElementById('editFormWrapper').classList.remove('hidden');
            document.querySelectorAll('.block-form').forEach(form => form.style.display = 'none');

            const targetForm = document.getElementById(`form-${blockName}`);
            if (targetForm) targetForm.style.display = 'block';

            if (blockName === 'hero') {
                document.getElementById('hero_headline').value = content.headline || '';
                document.getElementById('hero_subheadline').value = content.subheadline || '';
                document.getElementById('hero_video_url').value = content.video_url || '';
                document.getElementById('hero_cta_text').value = content.cta_text || '';
                document.getElementById('hero_cta_link').value = content.cta_link || '';
            }

            if (blockName === 'countdown') {
                document.getElementById('countdown_title').value = content.title || '';
                document.getElementById('countdown_subtitle').value = content.subtitle || '';
                document.getElementById('countdown_days').value = content.days || 0;
                document.getElementById('countdown_hours').value = content.hours || 0;
                document.getElementById('countdown_minutes').value = content.minutes || 0;
                document.getElementById('countdown_seconds').value = content.seconds || 0;
            }

            if (blockName === 'features') {
                document.getElementById('features_title').value = content.title || '';
                const featuresContainer = document.getElementById('features_items_wrapper');
                featuresContainer.innerHTML = '';

                if (Array.isArray(content.items)) {
                    content.items.forEach(item => {
                        const wrapper = document.createElement('div');
                        wrapper.classList.add('feature-item', 'mb-2', 'border', 'p-2', 'rounded', 'bg-gray-50');
                        wrapper.innerHTML = `
                            <x-input-text name="item_titles[]" label="Feature Title" value="${item.title || ''}" />
                            <x-input-text name="item_descriptions[]" label="Feature Description" value="${item.description || ''}" />
                        `;
                        featuresContainer.appendChild(wrapper);
                    });
                }
            }

            if (blockName === 'testimonials') {
                document.getElementById('testimonials_title').value = content.title || '';

                const container = document.getElementById('testimonials_items_wrapper');
                container.innerHTML = '';

                if (Array.isArray(content.testimonials)) {
                    content.testimonials.forEach(item => {
                        const wrapper = document.createElement('div');
                        wrapper.classList.add('testimonial-item', 'mb-2', 'border', 'p-2', 'rounded', 'bg-gray-50');
                        wrapper.innerHTML = `
                            <x-input-text name="names[]" label="Name" value="${item.name || ''}" />
                            <x-input-text name="feedbacks[]" label="Feedback" value="${item.feedback || ''}" />
                        `;
                        container.appendChild(wrapper);
                    });
                }
            }

        if (blockName === 'faq') {
            document.getElementById('faq_title').value = content.title || '';

            const faqContainer = document.getElementById('faq_items_wrapper');
            faqContainer.innerHTML = '';

            if (Array.isArray(content.questions)) {
                content.questions.forEach(item => {
                    const wrapper = document.createElement('div');
                    wrapper.classList.add('faq-item', 'mb-2', 'border', 'p-2', 'rounded', 'bg-gray-50');
                    wrapper.innerHTML = `
                        <x-input-text name="questions[]" label="Question" value="${item.q || ''}" />
                        <x-input-text name="answers[]" label="Answer" value="${item.a || ''}" />
                    `;
                    faqContainer.appendChild(wrapper);
                });
            }
        }

        if (blockName === 'messengerbtn') {
            document.getElementById('messenger_btn_text').value = content.btn_text || '';
            document.getElementById('messenger_btn_link').value = content.btn_link || '';
        }

        if (blockName === 'footer') {
            document.getElementById('footer_text').value = content.text || '';
            document.getElementById('footer_disclaimer').value = content.disclaimer || '';
        }



                });
            });
            

        // ✅ ADD FEATURE BUTTON HANDLER (outside the edit-btn loop)
        const addFeatureBtn = document.getElementById('add_feature_item_btn');
        if (addFeatureBtn) {
            addFeatureBtn.addEventListener('click', () => {
                const wrapper = document.createElement('div');
                wrapper.classList.add('feature-item', 'mb-2', 'border', 'p-2', 'rounded', 'bg-gray-50');
                wrapper.innerHTML = `
                    <x-input-text name="item_titles[]" label="Feature Title" />
                    <x-input-text name="item_descriptions[]" label="Feature Description" />
                `;
                document.getElementById('features_items_wrapper').appendChild(wrapper);
            });
        }

        const addTestimonialBtn = document.getElementById('add_testimonial_btn');
                if (addTestimonialBtn) {
                 addTestimonialBtn.addEventListener('click', () => {
                const wrapper = document.createElement('div');
                wrapper.classList.add('testimonial-item', 'mb-2', 'border', 'p-2', 'rounded', 'bg-gray-50');
                wrapper.innerHTML = `
                    <x-input-text name="names[]" label="Name" />
                    <x-input-text name="feedbacks[]" label="Feedback" />
                `;
                document.getElementById('testimonials_items_wrapper').appendChild(wrapper);
            });
        }



    const addFaqBtn = document.getElementById('add_faq_btn');
    if (addFaqBtn) {
        addFaqBtn.addEventListener('click', () => {
            const wrapper = document.createElement('div');
            wrapper.classList.add('faq-item', 'mb-2', 'border', 'p-2', 'rounded', 'bg-gray-50');
            wrapper.innerHTML = `
                <x-input-text name="questions[]" label="Question" />
                <x-input-text name="answers[]" label="Answer" />
            `;
            document.getElementById('faq_items_wrapper').appendChild(wrapper);
        });
    }


});
</script>


@endsection

@section('js')
<script>
$(document).ready(function() {
    @foreach ($funnel->blocks as $block)
    $('#toggle-active-form-{{ $block->id }}').on('submit', function(e) {
        e.preventDefault();

        const form = $(this);
        const blockId = form.data('id');
        const url = "{{ route('manage.blocks.toggleActive', ['block' => 'BLOCK_ID_PLACEHOLDER']) }}".replace('BLOCK_ID_PLACEHOLDER', blockId);

        Swal.fire({
            title: 'Are you sure?',
            text: "Want to change status?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes!',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: url,
                    type: 'POST',
                    data: form.serialize(),
                    success: function(response) {
                        Swal.fire('Updated!', 'Block status updated.', 'success').then(() => {
                            location.reload();
                        });
                    },
                    error: function() {
                        Swal.fire('Error!', 'Something went wrong.', 'error');
                    }
                });
            }
        });
    });
    @endforeach
});

</script>

<script>
    $(document).on('submit', '.sort-order-form', function (e) {
        e.preventDefault(); // Prevent normal form submission

        const form = $(this);
        const url = form.attr('action');
        const data = form.serialize();

        $.ajax({
            type: "POST",
            url: url,
            data: data,
            success: function (response) {
                Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: response.message,
                    confirmButtonText: 'Yes!',
                });
            },
            error: function (xhr) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Something went wrong.'
                });
            }
        });
    });
</script>

@endsection
