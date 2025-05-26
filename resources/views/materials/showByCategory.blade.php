@extends('layouts.users')

@section('title', ucfirst(request()->segment(3)) . ' Materials')

@section('content')
<div class="container m-auto p-4 sm:p-8 max-w-full">

    <h1 class="text-2xl font-bold mb-6 text-teal-700">{{ ucfirst(request()->segment(3)) }} Materials</h1>

    <div class="flex flex-col sm:flex-row flex-wrap">
        @forelse ($materials as $material)
        <div class="px-4 mb-8 w-full sm:w-1/3 max-w-xs text-center">

            @if($material->file_type === 'image' && $material->caption)
            <div class="max-h-16 overflow-auto p-2 mb-6 bg-gray-100 border border-gray-300 rounded-lg">
                <p id="caption-{{ $material->id }}" class="text-sm font-semibold">
                    {{ $material->caption }}
                </p>
            </div>
            <button onclick="copyCaption('caption-{{ $material->id }}')"
                class="mb-4 px-4 py-2 bg-teal-600 text-sm text-white rounded-md" type="button">
                Copy Caption
            </button>
            @endif

            <div class="relative group">
                @if($material->file_type === 'video')
                <video class="mx-auto rounded shadow-lg w-full h-50 object-cover" controls preload="metadata">
                    <source src="{{ asset('storage/' . $material->file_path) }}" type="video/mp4">
                </video>
                <div class="mt-2">
                    <a href="{{ asset('storage/' . $material->file_path) }}" download
                        class="inline-block bg-blue-600 text-white text-sm px-4 py-2 rounded flex items-center justify-center gap-2">
                        <i class="fas fa-cloud-download-alt"></i> Download Video
                    </a>
                </div>

                @elseif($material->file_type === 'image')
                <img src="{{ asset('storage/' . $material->file_path) }}" alt="{{ $material->title }}"
                    class="w-full h-[250px] lg:h-[270px] md:h-[300px] rounded-lg border" />
                <div
                    class="absolute inset-0 bg-black bg-opacity-50 flex items-center justify-center rounded-lg opacity-0 group-hover:opacity-100 transition-opacity cursor-pointer">
                    <a href="{{ asset('storage/' . $material->file_path) }}" download
                        class="bg-blue-600 text-white text-sm px-4 py-2 rounded flex items-center justify-center gap-2">
                        <i class="fas fa-cloud-download-alt"></i> Download
                    </a>
                </div>

                @else
                <img src="{{ asset('assets/images/pdf_thumbnail.jpg') }}" alt="{{ $material->title }}"
                    class="w-full h-auto rounded-lg shadow" />
                <div
                    class="absolute inset-0 bg-black bg-opacity-50 flex items-center justify-center rounded-lg opacity-0 group-hover:opacity-100 transition-opacity cursor-pointer">
                    <a href="{{ asset('storage/' . $material->file_path) }}" download
                        class="bg-blue-600 text-white text-sm px-4 py-2 rounded-lg flex items-center justify-center gap-2">
                        <i class="fas fa-cloud-download-alt"></i> Download
                    </a>
                </div>
                @endif
            </div>
        </div>
        @empty
        <p class="text-gray-500">No materials available for this category.</p>
        @endforelse
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function copyCaption(id) {
            const captionText = document.getElementById(id).textContent;
            navigator.clipboard.writeText(captionText)
                .then(() => {
                    Swal.fire({
                        icon: 'success',
                        title: 'Copied!',
                        text: 'Caption copied to clipboard.',
                        timer: 1500,
                        showConfirmButton: false,
                    });
                })
                .catch(err => {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Failed to copy caption.',
                    });
                });
        }
    </script>
</div>
@endsection
