@props([
    'icon' => null,
    'type' => 'submit',
])

<button type="{{ $type }}"
    {{ $attributes->merge(['class' => 'w-full text-white bg-green-600 hover:bg-green-700 focus:outline-none font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2 flex items-center justify-center gap-2']) }}>
    
    @if ($icon)
        <i class="{{ $icon }}"></i>
    @endif

    {{ $slot }}
</button>
