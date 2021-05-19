@props([
    'icon' => '',
    'class' => '',
    'type' => 'submit'
])
<div {{ $attributes->merge(['class' => $class]) }}>
    <button type="{{ $type }}"
       class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-500 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
    >
         <span class="absolute left-0 inset-y-0 flex items-center pl-3">
             {{ $icon }}
         </span>
        {{ $slot }}
    </button>
</div>
