@extends('layouts.users')

@section('title', 'Materials')

@section('content')

<div class="container mx-auto p-4 sm:p-8 w-full">

    <x-page-header-text title="Downloadable Materials" />

    @php
        $defaultThumbnail = asset('assets/images/materials_thumbnail.png');
        $videos = $materials->where('category', 'video');
        $images = $materials->where('category', 'image');
        $pdfs = $materials->where('category', 'pdf');
        $legalities = $materials->where('category', 'legalities');
    @endphp

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        {{-- Videos --}}
        <div
            class="bg-blue-50 hover:bg-blue-200 flex flex-col justify-center items-center text-center pt-4 border border-gray-300 rounded-3xl shadow-sm">
            <a href="{{ route('materials.showByType', 'video') }}"
                class="w-full flex flex-col items-center p-4 hover:opacity-80">
                <img src="{{ $defaultThumbnail }}" alt="Videos" class="w-3/5 h-auto mb-3">
                <p class="px-3 text-sm font-medium text-gray-700 truncate">
                    {{ $videos->count() ? $videos->first()->title : 'No videos uploaded.' }}
                </p>
            </a>
        </div>

        {{-- Images --}}
        <div
            class="bg-blue-50 hover:bg-blue-200 flex flex-col justify-center items-center text-center pt-4 border border-gray-300 rounded-3xl shadow-sm">
            <a href="{{ route('materials.showByType', 'image') }}"
                class="w-full flex flex-col items-center p-4 hover:opacity-80">
                <img src="{{ $defaultThumbnail }}" alt="Images" class="w-3/5 h-auto mb-3">
                <p class="px-3 text-sm font-medium text-gray-700 truncate">
                    {{ $images->count() ? $images->first()->title : 'No images uploaded.' }}
                </p>
            </a>
        </div>

        

        {{-- PDFs --}}
        <div
            class="bg-blue-50 hover:bg-blue-200 flex flex-col justify-center items-center text-center pt-4 border border-gray-300 rounded-3xl shadow-sm">
            <a href="{{ route('materials.showByType', 'pdf') }}"
                class="w-full flex flex-col items-center p-4 hover:opacity-80">
                <img src="{{ $defaultThumbnail }}" alt="PDFs" class="w-3/5 h-auto mb-3">
                <p class="px-3 text-sm font-medium text-gray-700 truncate">
                    {{ $pdfs->count() ? $pdfs->first()->title : 'No PDFs uploaded.' }}
                </p>
            </a>
        </div>

        {{-- Legalities --}}
        <div
            class="bg-blue-50 hover:bg-blue-200 flex flex-col justify-center items-center text-center pt-4 border border-gray-300 rounded-3xl shadow-sm">
            <a href="{{ route('materials.showByType', 'legalities') }}"
                class="w-full flex flex-col items-center p-4 hover:opacity-80">
                <img src="{{ $defaultThumbnail }}" alt="Legalities" class="w-3/5 h-auto mb-3">
                <p class="px-3 text-sm font-medium text-gray-700 truncate">
                    {{ $legalities->count() ? $legalities->first()->title : 'No legalities uploaded.' }}
                </p>
            </a>
        </div>
    </div>
</div>

@endsection
