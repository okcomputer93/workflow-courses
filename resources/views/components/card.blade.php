@props([
    'data' => ''
])
@php
    $grades = [3, 6, 12];
    $rotation = array_rand($grades);
    $rotation_class = "-rotate-$grades[$rotation]";
@endphp

<article class="bg-white rounded-sm shadow-lg rounded-md w-full hover:shadow-xl transition-shadow duration-300"
         style="max-width: 36rem;"
>
    <div class="flex items-center">
        <img class="w-44 h-44 transform {{ $rotation_class }} shadow-lg hover:shadow-xl transition-shadow duration-300"
             src="{{ asset($data->miniature) }}"
             alt="{{ $data->title .  "'s miniature" }}"
        >
        <div class="flex flex-col justify-between items-start h-80 w-full p-6">
            <div class="flex flex-wrap justify-between items-center space-x-2">
                <p class="flex-shrink-0 text-xs font-bold uppercase p-1 border border-category-{{ $data->category->id }} text-category-{{ $data->category->id }} rounded-lg"
                >
                    {{ ucwords(str_replace('_', ' ', $data->category->name)) }}
                </p>
                <p class="flex-shrink-0 text-xs font-bold uppercase p-1 border border-level-{{ $data->level->id }} text-level-{{ $data->level->id }} rounded-lg"
                >
                    {{ ucwords(str_replace('_', ' ', $data->level->name)) }}
                </p>
            </div>
            <h2 class="text-3xl font-bold">{{ $data->title }}</h2>
            <div>
                <x-rate :rate="$data->rate"
                        max="5"
                >
                </x-rate>
            </div>
            <p class="text-xs text-gray-500">{{ $data->owner->name }}</p>
            <div class="self-end">
                <x-button href="{{ $data->path() }}"
                          class="text-center text-sm px-8 rounded-full py-3 transition-colors duration-300"
                >
                    Detalles
                </x-button>
            </div>
        </div>
    </div>
</article>
