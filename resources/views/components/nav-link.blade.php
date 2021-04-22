@props(['route'])

@php
    $classes = Request::routeIs($route) ? 'text-gray-900 border-indigo-500' : 'hover:text-gray-900 hover:border-indigo-500 border-transparent';
@endphp

<a href="{{ route($route) }}" {{ $attributes->merge(['class' => 'inline-block mx-6 px-4 py-6 cursor-pointer text-base text-gray-400 font-medium border-b-2 ' . $classes]) }} >
    {{ $slot }}
</a>
