<div>
    <div class="mb-10 p-6 bg-white shadow-md rounded-lg" id="search-bar">
        <div class="flex space-y-6 flex-col justify-between items-center md:flex-row md:space-y-0">
            <div class="flex space-y-6 flex-col justify-between items-center w-full md:flex-row md:space-y-0 md:mr-10 md:space-x-2 xl:w-4/5">
                <h2 class="text-3xl text-center font-bold md:hidden">Buscar entre cursos</h2>
                <label class="sr-only" for="search">Buscar en los cursos</label>
                <input class="w-full appearance-none relative block px-3 py-2 border border-gray-300 placeholder-gray-300 text-gray-600 rounded-md focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 focus:z-10 sm:text-base md:w-1/2"
                       wire:model.debounce.1s="search"
                       type="text" id="search"
                       name="search"
                       placeholder="Busca por título, profesor..."
                       autofocus
                >

                <label class="sr-only" for="categories">Busca por categoría</label>
                <select class="bg-white px-3 py-2 border border-gray-300 rounded-md focus:outline-none text-gray-600 focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 focus:z-10 sm:text-base"
                        wire:model="category"
                        name="categories"
                        id="categories"
                >
                    <option class="text-gray-700 hover:bg-indigo-500"
                            value=""
                            selected
                    >
                        Todas las Categorías
                    </option>

                    @foreach ($categories as $category)
                        <option class="text-gray-700 hover:bg-indigo-500"
                                value="{{ $category->name }}"
                        >
                            {{ ucwords(str_replace('_', ' ', $category->name)) }}
                        </option>
                    @endforeach

                </select>

                <label class="sr-only" for="levels">Busca por niveles</label>
                <select class="bg-white px-3 py-2 border border-gray-300 rounded-md focus:outline-none text-gray-600 focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 focus:z-10 sm:text-base"
                        wire:model="level"
                        name="levels"
                        id="levels"
                >
                    <option class="text-gray-700 hover:bg-indigo-500"
                            value=""
                            selected
                    >
                        Todos los Niveles
                    </option>

                    @foreach ($levels as $level)
                        <option class="text-gray-700 hover:bg-indigo-500"
                                value="{{ $level->name }}"
                        >
                            {{ ucwords(str_replace('_', ' ', $level->name)) }}
                        </option>
                    @endforeach

                </select>
            </div>
            <div>
                <div wire:click.prevent="resetSearch">
                    <x-button href="#">Reset</x-button>
                </div>
            </div>
        </div>
    </div>

    <div class="grid justify-items-center grid-rows-1 grid-flow-row grid-cols-1 gap-y-12 md:grid-cols-2 xl:gap-x-12"
         wire:loading.remove
    >
        @foreach ($courses as $course)
            <x-card :data="$course"></x-card>
        @endforeach
    </div>

    <div class="hidden grid justify-items-center grid-rows-1 grid-flow-row grid-cols-1 gap-y-12 md:grid-cols-2 xl:gap-x-12"
         wire:loading.class.remove="hidden"
    >
        @for ($i = 1; $i <= $resultsPerPage; $i++)
            <x-skeleton-card></x-skeleton-card>
        @endfor
    </div>

    @if (count($courses) <= 0)
        <div class="flex justify-center items-center">
            <div class="p-10 text-center bg-white w-1/2 shadow rounded-md">
                <h2 class="text-xl font-bold text-gray-800">La búsqueda no arrojó ningún resultado</h2>
                <p class="pt-2 text-base text-indigo-500">Intenta con otros términos</p>
            </div>
        </div>
    @endif

    <div class="mt-10"
         wire:loading.remove
    >
        {{ $courses->links() }}
    </div>
    <x-scroll to="search-bar"></x-scroll>
</div>


