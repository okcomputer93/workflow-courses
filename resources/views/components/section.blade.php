@props([
    'type' => 'base',
    'background' => [
        'base' => 'bg-gray-100',
        'clean' => 'bg-white'
    ]
])
<section class="py-8 {{ $background[$type] }} shadow-inner">
    <div class="mx-auto max-w-7xl px-6">
        {{ $slot }}
    </div>
</section>

