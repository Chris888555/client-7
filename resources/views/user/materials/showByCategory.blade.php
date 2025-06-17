@extends('layouts.users')

@section('title', 'Marketing Tools')

@section('content')
<div class="container m-auto p-4 sm:p-8 max-w-full">

    <x-page-header-text title="Marketing Tools" />


    <div
        class="w-full p-4 bg-gray-100 border-x border-t border-gray-300 rounded-t-lg flex justify-between items-center">
        <div class="font-semibold">
            {{ optional($materials->first())->category ?? 'No Title Available' }}
        </div>

        <div class="text-right">
            <div class="text-sm text-gray-600 bg-gray-200 p-2 rounded-md">
                {{ $materials->count() }} {{ Str::plural('item', $materials->count()) }}
            </div>

        </div>
    </div>

  <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 bg-gray-50 border-x border-b border-gray-300 rounded-b-lg p-4">

        @forelse ($materials as $material)
       <div class="w-full text-center">


            {{-- Caption for images --}}
            @if($material->category === 'Marketing Images' && $material->caption)
       
                <div class="max-h-16 overflow-auto p-2 my-4 bg-gray-100 border border-gray-300 rounded-lg">
                    <p id="caption-{{ $material->id }}" class="p-4 text-sm font-semibold">
                        {{ $material->caption }}
                    </p>
                </div>
                <div class="flex justify-center">
                    <button onclick="copyCaption('caption-{{ $material->id }}')"
                        class="mb-4 px-4 py-2 bg-[#e8f5e9] text-[#4caf50] text-sm rounded-md flex items-center gap-2"
                        type="button">
                        <svg class="h-5 w-5 text-[#4caf50]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 7v8a2 2 0 002 2h6M8 7V5a2 2 0 012-2h4.586a1 1 0 01.707.293l4.414 4.414a1 1 0 01.293.707V15a2 2 0 01-2 2h-2M8 7H6a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2v-2" />
                        </svg>
                        Copy Caption
                    </button>
                </div>


                @endif


                <div class="relative group">
            {{-- Marketing Videos --}}
            @if($material->category === 'Marketing Videos')
            <div class="my-4 p-4 bg-white border rounded-lg">
                <div class="py-2  mb-4 ">
                    <h2 class="text-gray-600 font-semibold">{{ $material->title }}</h2>
                </div>
                <video class="mx-auto border rounded w-full h-50 object-cover" controls preload="metadata">
                    <source src="{{ asset('storage/' . $material->file_path) }}" type="video/mp4">
                </video>
                <div class="mt-2">
                    <a href="{{ asset('storage/' . $material->file_path) }}" download
                        class="inline-block bg-[#e3f2fd] text-[#2196f3] text-sm px-4 py-2 rounded flex items-center justify-center gap-2">
                        <i class="fas fa-cloud-download-alt"></i> Download Video
                    </a>
                </div>
            </div>

            {{-- Marketing Images --}}
            @elseif($material->category === 'Marketing Images')
            <img src="{{ asset('storage/' . $material->file_path) }}" alt="{{ $material->title }}"
                class="w-full h-[250px] lg:h-[270px] md:h-[300px] rounded-lg border mb-4" />
            <div
                class="absolute inset-0 bg-black bg-opacity-50 flex items-center justify-center rounded-lg opacity-0 group-hover:opacity-100 transition-opacity cursor-pointer">
                <a href="{{ asset('storage/' . $material->file_path) }}" download
                    class="bg-blue-600 text-white text-sm px-4 py-2 rounded flex items-center justify-center ">
                    <i class="fas fa-cloud-download-alt"></i> Download
                </a>
            </div>

            {{-- Company Documents --}}
            @elseif($material->category === 'Company Documents')
            <div class="my-4 p-4 bg-white border rounded-lg">
                {{-- Title --}}
                <div class="mb-2">
                    <h2 class="text-gray-600 font-semibold">{{ $material->title }}</h2>
                </div>

                {{-- Image --}}
                <div class="mb-4">
                    <img src="{{ asset('storage/' . $material->file_path) }}" alt="{{ $material->title }}"
                        class="w-full h-[200px] rounded-lg shadow" />
                </div>

                <div class="flex gap-3">
                    <a href="{{ asset('storage/' . $material->file_path) }}" target="_blank"
                        class="bg-[#e8f5e9] text-[#4caf50] text-sm px-4 py-2 rounded-md flex items-center justify-center gap-2">
                        <i class="fas fa-external-link-alt"></i> Open Full
                    </a>
                    <a href="{{ asset('storage/' . $material->file_path) }}" download
                        class="bg-[#e3f2fd] text-[#2196f3] text-sm px-4 py-2 rounded-md flex items-center justify-center gap-2">
                        <i class="fas fa-cloud-download-alt"></i> Download
                    </a>
                </div>
            </div>

            {{-- PDFs or other files --}}
            @else
            <div class="my-4 p-4 bg-white border rounded-lg">
                {{-- Title --}}
                <div class="mb-2">
                    <h2 class="text-gray-600 font-semibold">{{ $material->title }}</h2>
                </div>

                {{-- PDF Thumbnail --}}
                <div class="mb-4">
                    <img src="{{ asset('assets/images/pdf_thumbnail.jpg') }}" alt="{{ $material->title }}"
                        class="w-full h-[200px] rounded-lg shadow" />
                </div>

                {{-- Action Buttons --}}
                <div class="flex gap-3">
                    <a href="{{ asset('storage/' . $material->file_path) }}" target="_blank"
                        class="bg-[#e8f5e9] text-[#4caf50] text-sm px-4 py-2 rounded-md flex items-center justify-center gap-2">
                        <i class="fas fa-external-link-alt"></i> Open Full
                    </a>
                    <a href="{{ asset('storage/' . $material->file_path) }}" download
                        class="bg-[#e3f2fd] text-[#2196f3] text-sm px-4 py-2 rounded-md flex items-center justify-center gap-2">
                        <i class="fas fa-cloud-download-alt"></i> Download
                    </a>
                </div>
            </div>
            @endif
        </div>

    </div>
            <!--For No Data Found Code-->
            @empty
            <x-no-materials />
            @endforelse

            <!--For No Data Found Code End-->
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