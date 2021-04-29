@props([
    'type' => 'base',
    'background' => [
        'base' => 'bg-gray-100',
        'clean' => 'bg-white',
        'dark' => 'bg-blue-dark'
    ],
    'class' => ''
])
<section {{ $attributes->merge(['class' => "py-8 $background[$type] shadow-inner " . $class]) }}>
    <div class="mx-auto max-w-7xl px-6">
        {{ $slot }}
    </div>
</section>

