@extends('layouts.admin')

@section('title', 'Add Testimonials') 

@section('content')
<div class="container m-auto p-4 sm:p-8 max-w-full">

{{-- ✅ Buttons --}}
<div class="flex items-center justify-center max-w-[350px] mx-auto p-2 bg-gray-50 rounded-2xl border gap-2">
    {{-- Create Packages --}}
    <a href="{{ route('admin.testimonials.create') }}"
        class="w-full text-center px-5 py-2 rounded-xl transition cursor-pointer 
        {{ request()->routeIs('admin.testimonials.create') 
            ? 'bg-blue-600 text-white hover:bg-blue-700' 
            : 'bg-gray-100 hover:bg-gray-200 text-gray-700' }}">
        Create Testi
    </a>

    {{-- List Packages --}}
    <a href="{{ route('admin.testimonials.list') }}"
        class="w-full text-center px-5 py-2 rounded-xl transition cursor-pointer 
        {{ request()->routeIs('admin.testimonials.list') 
            ? 'bg-blue-600 text-white hover:bg-blue-700' 
            : 'bg-gray-100 hover:bg-gray-200 text-gray-700' }}">
        List Testi
    </a>
</div>
   
<div class="mt-6 mb-6">
    <form id="testimonialForm" action="{{ route('admin.testimonials.store') }}" method="POST">
        @csrf

        <!-- Name -->
        <div class="mb-4">
            <x-input-text 
                label="Name" 
                name="name" 
                placeholder="Enter name" 
                required="true" />
        </div>

        <!-- Message -->
        <div class="mb-4">
            <x-input-text 
                label="Message" 
                name="message" 
                placeholder="Enter testimonial message" 
                type="textarea" 
                rows="4" 
                required="true" />
        </div>

        <!-- Video Link -->
        <div class="mb-4">
            <x-input-text 
                label="Video Link (optional)" 
                name="video_link" 
                placeholder="Enter YouTube/Mp4 link" />
        </div>

       <!-- Submit -->
        <button type="submit" 
                class="mt-4 w-full py-3 bg-blue-600 hover:bg-blue-700 
                    text-white font-semibold rounded-xl shadow transition flex items-center justify-center gap-2">
            <i class="fa fa-save"></i>
            Save Testimonial
        </button>

    </form>
    </div>

</div>
@endsection

@section('js')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
document.getElementById('testimonialForm').addEventListener('submit', function(e) {
    e.preventDefault(); // stop default submit

    let form = this;
    let formData = new FormData(form);

    fetch(form.action, {
        method: 'POST',
        body: formData,
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        }
    })
    .then(res => res.json())
    .then(data => {
        if(data.status === 'success'){
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: data.message,
                confirmButtonColor: '#3085d6'
            });
            form.reset(); // clear form fields after success
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Validation failed or something went wrong.'
            });
        }
    })
    .catch(err => {
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Something went wrong!'
        });
    });
});
</script>
@endsection
