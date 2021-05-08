@props([
    'data' => ''
])
<article class="max-w-xs bg-white rounded-md shadow-md overflow-hidden">
    <div class="relative">
        <img src="{{ asset($data->miniature) }}" alt="{{ $data->title .  "'s miniature" }}">
        <span class="absolute rounded-md text-xs text-white top-2 left-2 p-2 bg-category-{{ $data->category->id }}"
        >{{ ucwords(str_replace('_', ' ', $data->category->name)) }}</span>
    </div>
    <div class="p-6 flex flex-col h-52 justify-center">
        <h4 class="flex-1 pb-2 text-md font-bold">{{ $data->title }}</h4>
        <p class="flex-1 font-medium text-gray-400 text-sm">Profesor: {{ $data->owner->name }}</p>
        <x-rate :rate="$data->rate" max="5"></x-rate>
        <x-button href="{{ $data->path() }}" class="w-full text-center">Más información</x-button>
    </div>
</article>