@extends('layouts.admin')

@section('title', 'Create Package')

@section('content')
<div class="container m-auto p-4 sm:p-8 max-w-full">
  

{{-- ✅ Buttons --}}
<div class="flex items-center justify-center max-w-[350px] mx-auto p-2 bg-gray-50 rounded-2xl border gap-2">
    {{-- Create Packages --}}
    <a href="{{ route('packages.create') }}"
        class="w-full text-center px-5 py-2 rounded-xl transition cursor-pointer 
        {{ request()->routeIs('packages.create') 
            ? 'bg-blue-600 text-white hover:bg-blue-700' 
            : 'bg-gray-100 hover:bg-gray-200 text-gray-700' }}">
        Create Packages
    </a>

    {{-- List Packages --}}
    <a href="{{ route('packages.list') }}"
        class="w-full text-center px-5 py-2 rounded-xl transition cursor-pointer 
        {{ request()->routeIs('packages.list') 
            ? 'bg-blue-600 text-white hover:bg-blue-700' 
            : 'bg-gray-100 hover:bg-gray-200 text-gray-700' }}">
        List Packages
    </a>
</div>


<div class="mt-6 mb-6">
    <form id="packageForm" action="{{ route('packages.store') }}" method="POST" enctype="multipart/form-data"
          class="bg-white border rounded-2xl shadow-sm p-6 space-y-5">
        @csrf

        <!-- Package Name -->
        <x-input-text 
            label="Package Name" 
            name="name" 
            placeholder="e.g., Starter Plan" 
            required />

        <!-- Price -->
        <x-input-text 
            label="Price (₱)" 
            name="price" 
            type="number" 
            placeholder="e.g., 499.00" 
            required />

        <!-- Features -->
        <div id="featuresWrap" class="space-y-3">
            <div class="flex items-center justify-between">
                <label class="text-sm font-semibold text-gray-500">Features</label>
                <button type="button" id="addFeature" 
                        class="text-sm px-3 py-1 rounded-lg border hover:bg-gray-50">
                    + Add Feature List
                </button>
            </div>

            <!-- Default feature row -->
            <div class="feature-item flex gap-2">
                <input name="features[]" type="text" 
                       class="flex-1 px-4 py-2 border rounded-md focus:outline-none focus:ring focus:ring-gray-200" 
                       placeholder="e.g., Free Sales Funnel" required>
                <button type="button" 
                        class="removeFeature px-3 py-2 border rounded-lg hover:bg-gray-50">
                    Remove
                </button>
            </div>
        </div>

        <!-- Image Upload -->
        <div>
            <label class="block text-sm font-semibold text-gray-600 mb-2">Upload Image </label>
            <div class="flex items-center justify-center w-full">
                <label for="image"
                       class="flex flex-col items-center justify-center w-full border-2 border-dashed rounded-xl cursor-pointer 
                              bg-gray-50 hover:border-green-400 transition p-6 text-center border-gray-300">
                    
                    <!-- Icon + Text -->
                    <div class="flex flex-col items-center justify-center">
                        <svg class="w-12 h-12 mb-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6h.1a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
                        </svg>
                        <p class="mb-1">Click to upload or drag image here</p>
                        <small class="text-gray-400">Only JPG or PNG (max 2MB)</small>
                    </div>

                    <!-- File input -->
                    <input id="image" name="image" type="file" accept="image/*" class="hidden" />

                    <!-- File path inside the border -->
                    <p id="fileName" class="mt-2 text-sm text-blue-600 font-semibold"></p>
                </label>
            </div>
        </div>

        <script>
        document.getElementById('image').addEventListener('change', function (e) {
            const file = e.target.files[0];
            const fileNameEl = document.getElementById('fileName');
            fileNameEl.textContent = file ? file.name : "";
        });
        </script>

        <!-- Submit -->
       <button type="submit" 
            class="w-full py-3 bg-blue-600 hover:bg-blue-700 
                text-white font-semibold rounded-xl shadow transition flex items-center justify-center gap-2">
            <i class="fas fa-floppy-disk"></i>
            Save Package
        </button>

    </form>
    </div>

</div>
@endsection

@section('js')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('packageForm');
    const featuresWrap = document.getElementById('featuresWrap');
    const addFeatureBtn = document.getElementById('addFeature');

    // Add new feature row
    addFeatureBtn.addEventListener('click', () => {
        const row = document.createElement('div');
        row.className = 'feature-item flex gap-2';
        row.innerHTML = `
            <input name="features[]" type="text" 
                   class="flex-1 px-4 py-2 border rounded-md focus:outline-none focus:ring focus:ring-gray-200" 
                   placeholder="e.g., Unlimited Support" required>
            <button type="button" 
                    class="removeFeature px-3 py-2 border rounded-lg hover:bg-gray-50">
                Remove
            </button>`;
        featuresWrap.appendChild(row);

        row.querySelector('.removeFeature').addEventListener('click', () => row.remove());
    });

    // Bind initial remove button
    document.querySelectorAll('.removeFeature').forEach(btn => {
        btn.addEventListener('click', (e) => e.target.closest('.feature-item').remove());
    });

    // AJAX submit
    form.addEventListener('submit', function(e) {
        e.preventDefault();

        let formData = new FormData(this);

        fetch(this.action, {
            method: "POST",
            headers: {
                "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content")
            },
            body: formData
        })
        .then(async (res) => {
            if (!res.ok) {
                const errorData = await res.json();
                throw errorData;
            }
            return res.json();
        })
        .then(data => {
            Swal.fire({
                icon: "success",
                title: "Success!",
                text: data.message,
                confirmButtonText: "OK",
            }).then(() => {
                location.reload();
            });

            form.reset();
            featuresWrap.querySelectorAll('.feature-item').forEach((el, i) => {
                if (i > 0) el.remove();
            });
        })
        .catch(error => {
            let msg = "Something went wrong.";
            if (error && error.message) {
                msg = typeof error.message === "object" 
                      ? Object.values(error.message).flat().join("\n") 
                      : error.message;
            }
            Swal.fire({
                icon: "error",
                title: "Oops!",
                text: msg,
                confirmButtonText: "OK"
            });
        });
    });
});
</script>
@endsection
