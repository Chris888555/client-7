@props([
    'label',
    'name',
    'id' => $name,
    'type' => 'text',
    'placeholder' => '',
    'required' => false,
])

<div>
    <label for="{{ $id }}" class="block text-sm font-semibold text-gray-500 mb-2">
        {{ $label }}
    </label>
    <input
        type="{{ $type }}"
        name="{{ $name }}"
        id="{{ $id }}"
        placeholder="{{ $placeholder }}"
        @if($required) required @endif
        {{ $attributes->merge([
            'class' => 'w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-gray-200'
        ]) }}
    />
</div>
