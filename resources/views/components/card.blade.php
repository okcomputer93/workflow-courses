@props([
    'data' => ''
])

<article class="bg-white rounded-sm shadow-lg rounded-md hover:shadow-xl transition-shadow duration-300 z-10 overflow-hidden course-card w-72 h-96 xl:h-80 xl:w-full">
    <div class="flex items-center h-full w-full flex-col xl:flex-row">
        <img class="w-32 h-32 shadow-xl hover:shadow-xl transition-shadow duration-300 xl:w-44 xl:h-44"
             src="{{ asset($data->miniature) }}"
             alt="{{ $data->title .  "'s miniature" }}"
        >
        <div class="flex flex-col justify-between h-full w-full items-center p-6 xl:items-start">
            <div class="flex flex-wrap justify-between items-center space-x-2">
                <p class="flex-shrink-0 text-xs font-normal p-1 border border-category-{{ $data->category->id }} text-category-{{ $data->category->id }} rounded-xl xl:font-bold xl:uppercase"
                >
                    {{ ucwords(str_replace('_', ' ', $data->category->name)) }}
                </p>
                <p class="flex-shrink-0 text-xs font-normal p-1 border border-level-{{ $data->level->id }} text-level-{{ $data->level->id }} rounded-xl xl:font-bold xl:uppercase"
                >
                    {{ ucwords(str_replace('_', ' ', $data->level->name)) }}
                </p>
            </div>
            <h2 class="text-xl text-center font-bold xl:text-3xl xl:text-left">{{ $data->title }}</h2>
            <div>
                <x-rate :rate="$data->rate"
                        max="5"
                >
                </x-rate>
            </div>
            <p class="text-xs text-gray-500">{{ $data->owner->name }}</p>
            <div class="xl:self-end">
                <x-button href="{{ $data->path() }}"
                          class="text-center text-sm px-4 rounded-full py-2 transition-colors duration-300 xl:px-8 xl:py-3"
                >
                    Detalles
                </x-button>
            </div>
        </div>
    </div>
</article>
