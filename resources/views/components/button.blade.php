@props([
    'href' => '',
    'class' => ''
    ])

<a class="py-2 px-4 shadow-md rounded-md bg-indigo-500 hover:bg-indigo-700 inline-block text-white text-center {{ $class }}" href="{{ $href }}">
    {{ $slot }}
</a>
