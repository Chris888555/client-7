@extends('layouts.users')

@section('title', 'Materials')

@section('content')

<div class="container mx-auto p-4 sm:p-8 w-full">

    <x-page-header-text title="Downloadable Materials" />

   @php
    $defaultThumbnail = asset('assets/images/materials_thumbnail.png');
    $videos = $materials->where('category', 'Marketing Videos');
    $images = $materials->where('category', 'Marketing Images');
    $pdfs = $materials->where('category', 'PDF Slides Copy');
    $legalities = $materials->where('category', 'Company Documents');
@endphp


    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        {{-- Videos --}}
        <div
            class="bg-blue-50 hover:bg-blue-200 flex flex-col justify-center items-center text-center  border border-gray-300 rounded-3xl shadow-sm">
           <a href="{{ route('materials.showByCategory', urlencode('Marketing Videos')) }}"
                class="w-full flex flex-col items-center p-4 hover:opacity-80">
                <img src="{{ $defaultThumbnail }}" alt="Videos" class="w-3/5 h-auto mb-3">
                <p class="px-3 text-sm font-medium text-gray-700 truncate">
                   {{ $videos->count() ? 'Marketing Videos' : 'No videos uploaded.' }}
                </p>
            </a>
        </div>

        {{-- Images --}}
        <div
            class="bg-blue-50 hover:bg-blue-200 flex flex-col justify-center items-center text-center  border border-gray-300 rounded-3xl shadow-sm">
         <a href="{{ route('materials.showByCategory', urlencode('Marketing Images')) }}"
                class="w-full flex flex-col items-center p-4 hover:opacity-80">
                <img src="{{ $defaultThumbnail }}" alt="Images" class="w-3/5 h-auto mb-3">
                <p class="px-3 text-sm font-medium text-gray-700 truncate">
                  {{ $images->count() ? 'Marketing Images' : 'No images uploaded.' }}
                </p>
            </a>
        </div>

        

        {{-- PDFs --}}
        <div
            class="bg-blue-50 hover:bg-blue-200 flex flex-col justify-center items-center text-center  border border-gray-300 rounded-3xl shadow-sm">
           <a href="{{ route('materials.showByCategory', urlencode('PDF Slides Copy')) }}"
                class="w-full flex flex-col items-center p-4 hover:opacity-80">
                <img src="{{ $defaultThumbnail }}" alt="PDFs" class="w-3/5 h-auto mb-3">
                <p class="px-3 text-sm font-medium text-gray-700 truncate">
                  {{ $pdfs->count() ? 'PDF Slides Copy' : 'No PDFs uploaded.' }}
                </p>
            </a>
        </div>

        {{-- Legalities --}}
        <div
            class="bg-blue-50 hover:bg-blue-200 flex flex-col justify-center items-center text-center  border border-gray-300 rounded-3xl shadow-sm">
         <a href="{{ route('materials.showByCategory', urlencode('Company Documents')) }}"
                class="w-full flex flex-col items-center p-4 hover:opacity-80">
                <img src="{{ $defaultThumbnail }}" alt="Legalities" class="w-3/5 h-auto mb-3">
                <p class="px-3 text-sm font-medium text-gray-700 truncate">
                  {{ $legalities->count() ? 'Company Documents' : 'No documents uploaded.' }}
                </p>
            </a>
        </div>
    </div>
</div>

@endsection
