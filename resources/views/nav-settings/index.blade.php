@extends('layouts.app')

@section('title', 'Nav Setting')

@section('content')
@include('includes.nav')

<style>


</style>
<div class="container m-auto p-4 sm:p-8 max-w-full">
    <h1 class="text-2xl md:text-3xl font-bold text-left text-blue-400">Navigation Settings</h1>
    <p class="text-gray-600 text-left mb-4">Adjust and customize your navigation theme to match your preferences.</p>

    <div class="mt-8">
        <form action="{{ route('nav-settings.update') }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')

            <!-- Nav Background Color -->
            <div class="form-group flex flex-col md:flex-row md:items-center gap-2 md:gap-4 w-full">
                <label for="nav_bg_color" class="font-semibold w-full md:w-1/4">Nav Background Color</label>
                <div class="w-full md:w-3/4 h-14">
                    <input type="color" name="nav_bg_color" id="nav_bg_color"
                        class="form-input border border-gray-300 rounded w-full h-full p-2 cursor-pointer"
                        value="{{ old('nav_bg_color', $navSettings->nav_bg_color ?? '#ffffff') }}">
                </div>
                @error('nav_bg_color')
                <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <!-- Nav Text Color -->
            <div class="form-group flex flex-col md:flex-row md:items-center gap-2 md:gap-4 w-full">
                <label for="nav_text_color" class="font-semibold w-full md:w-1/4">Nav Text Color</label>
                <div class="w-full md:w-3/4 h-14">
                    <input type="color" name="nav_text_color" id="nav_text_color"
                        class="form-input border border-gray-300 rounded w-full h-full p-2 cursor-pointer"
                        value="{{ old('nav_text_color', $navSettings->nav_text_color ?? '#000000') }}">
                </div>
                @error('nav_text_color')
                <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <!-- List Text Hover Color -->
            <div class="form-group flex flex-col md:flex-row md:items-center gap-2 md:gap-4 w-full">
                <label for="nav_text_list_hover_color" class="font-semibold w-full md:w-1/4">Nav List Text Hover
                    Color</label>
                <div class="w-full md:w-3/4 h-14">
                    <input type="color" name="nav_text_list_hover_color" id="nav_text_list_hover_color"
                        class="form-input border border-gray-300 rounded w-full h-full p-2 cursor-pointer"
                        value="{{ old('nav_text_list_hover_color', $navSettings->nav_text_list_hover_color ?? '#ff5733') }}">
                </div>
                @error('nav_text_list_hover_color')
                <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <!-- List Background Hover Color -->
            <div class="form-group flex flex-col md:flex-row md:items-center gap-2 md:gap-4 w-full">
                <label for="nav_list_bg_hover_color" class="font-semibold w-full md:w-1/4">Nav List Background Hover
                    Color</label>
                <div class="w-full md:w-3/4 h-14">
                    <input type="color" name="nav_list_bg_hover_color" id="nav_list_bg_hover_color"
                        class="form-input border border-gray-300 rounded w-full h-full p-2 cursor-pointer"
                        value="{{ old('nav_list_bg_hover_color', $navSettings->nav_list_bg_hover_color ?? '#333333') }}">
                </div>
                @error('nav_list_bg_hover_color')
                <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <!-- Submit Button -->
            <div class="form-group">
                <button type="submit"
                    class="rounded-lg bg-blue-700 px-6 py-2 text-sm font-medium text-white shadow-sm transition duration-200 hover:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50 flex items-center">

                       <!-- SVG Icon -->
        <svg class="h-5 w-5 text-white mr-2" width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
            stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
            <path stroke="none" d="M0 0h24v24H0z" />
            <path d="M6 4h10l4 4v10a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2" />
            <circle cx="12" cy="14" r="2" />
            <polyline points="14 4 14 8 8 8 8 4" />
        </svg>

                    Save Settings
                </button>


            </div>
        </form>
    </div>
</div>
@endsection