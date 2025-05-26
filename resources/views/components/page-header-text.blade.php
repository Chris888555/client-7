@props([
    'title',
    'subtitle',
    'titleColor' => 'text-teal-700',         {{-- change to your global preferred color --}}
    'subtitleColor' => 'text-gray-800'      {{-- change to your global preferred subtitle color --}}
])

<div class="mb-6">
    <h1 class="text-1xl md:text-2xl font-bold text-left {{ $titleColor }}">
        {{ $title }}
    </h1>
</div>
