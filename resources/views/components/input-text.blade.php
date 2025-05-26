@props([
    'label',
    'name',
    'id' => $name,
    'type' => 'text',
    'placeholder' => '',
    'required' => false,
])

<div>
    <label for="{{ $id }}" class="block text-sm font-semibold text-gray-800 mb-2">
        {{ $label }}
    </label>
    <input
        type="{{ $type }}"
        name="{{ $name }}"
        id="{{ $id }}"
        placeholder="{{ $placeholder }}"
        @if($required) required @endif
        {{ $attributes->merge([
            'class' => 'w-full px-4 py-3 border border-gray-300 rounded-lg
                        focus:outline-none focus:ring-4 focus:ring-teal-400 focus:ring-opacity-50
                        focus:border-teal-400 transition-shadow duration-300'
        ]) }}
    />
</div>
