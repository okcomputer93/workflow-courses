@props([
    'route' => '',
    'class' => ''
])

@php
    $classes = Request::routeIs($route) ? 'text-gray-100 border-indigo-500' : 'hover:text-gray-100 text-gray-400 hover:border-indigo-500 border-transparent';
@endphp

<a href="{{ route($route) }}" {{ $attributes->merge(['class' => 'inline-block mx-6 px-4 py-6 cursor-pointer text-base font-medium border-b-4 ' . $classes . ' ' . $class]) }} >
    {{ $slot }}
</a>
