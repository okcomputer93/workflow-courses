@props([
    'name' => '',
    'type' => 'text',
    'placeholder' => '',
    'class' => '',
    'value' => '',
    'reference' => '',
    'focus' => false,
    'required' => true,
])

<div class="floating-input mb-5 relative">
    <input id="{{ $name }}"
           name="{{ $name }}"
           type="{{ $type }}"
           class="w-full p-3 border border-gray-300 placeholder-gray-300 text-gray-600 rounded-md focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 focus:z-10 sm:text-base h-14"
           placeholder="{{ $slot }}"
           value="{{ old($name) ?? $value }}"
           @if ($required)
               required
           @endif
    >
    <label for="{{ $name }}" class="absolute top-0 left-0 px-3 py-5 h-full pointer-events-none transform origin-left transition-all duration-100 ease-in-out leading-none text-gray-500" >{{ $slot }}</label>
    @error($name)
        <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
    @enderror
</div>
