@props([
    'title',
    'subtitle',
    'titleColor' => 'text-teal-700',         {{-- change to your global preferred color --}}
    'subtitleColor' => 'text-gray-800'      {{-- change to your global preferred subtitle color --}}
])

<div class="mb-6">
    <h1 class="text-2xl md:text-3xl font-bold text-left {{ $titleColor }}">
        {{ $title }}
    </h1>
    <p class="text-left mb-4 {{ $subtitleColor }}">
        {{ $subtitle }}
    </p>
</div>
