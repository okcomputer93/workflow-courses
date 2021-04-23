@props([
    'name' => '',
    'type' => 'text',
    'placeholder' => '',
    'class' => '',
])
@php
    $placeholder = ucfirst($name);
@endphp

<div class="{{ $class }}">
    <label for="{{ $name }}" class="sr-only">{{ $slot }}</label>
    <input id="{{ $name }}" name="{{ $name }}" type="{{ $type }}" class="w-full appearance-none relative block px-3 py-2 border border-gray-300 placeholder-gray-300 text-gray-600 rounded-md focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 focus:z-10 sm:text-base" placeholder="{{ $placeholder }}" autofocus>
    @error($name)
        <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
    @enderror
</div>
