@props([
    'class' => '',
    'route' => '',
])

<a {{ $attributes->merge(['class' => 'px-4 text-gray-400 text-sm sm:text-base py-3 sm:py-0 font-normal hover:text-gray-600 ' . $class]) }}
   href="{{ $route }}"
>
    {{ $slot }}
</a>
