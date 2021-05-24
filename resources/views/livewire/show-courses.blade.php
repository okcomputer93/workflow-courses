<div>
    <div class="mb-10 p-6 bg-white shadow-md rounded-lg"
         x-data="onScrolling()"
         x-ref="searchbar"
         @search-updated.window="top()"
         @scroll.window.passive="toggleButton()"
    >
        <div class="flex justify-between items-center">
            <div class="flex justify-between items-center w-4/5">
                <label class="sr-only" for="search">Buscar en los cursos</label>
                <input class="w-1/2 appearance-none relative block px-3 py-2 border border-gray-300 placeholder-gray-300 text-gray-600 rounded-md focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 focus:z-10 sm:text-base"
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
                                value="{{ $category->id }}"
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
                                value="{{ $level->id }}"
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

        <div class="fixed right-6 bottom-6"
             x-show="buttonVisible"
             @click="top()"
             x-transition:enter="transition duration-300 transform ease-out"
             x-transition:enter-start="scale-50 opacity-0"
             x-transition:leave="transition duration-300 transform ease-out"
             x-transition:leave-end="scale-50 opacity-0"
        >
            <div class="w-6 h-6 flex justify-center items-center bg-indigo-500 p-10 rounded-full shadow-md cursor-pointer hover:bg-indigo-700">
                <div class="text-white">
                    <x-icon.arrow-up></x-icon.arrow-up>
                </div>
            </div>
        </div>

    </div>

    <div class="grid justify-items-center grid-rows-1 grid-flow-row grid-cols-3 gap-y-16"
         wire:loading.remove
    >
        @foreach ($courses as $course)
            <x-card :data="$course"></x-card>
        @endforeach
    </div>

    <div wire:loading.class.remove="hidden" class="hidden flex justify-center items-center py-8">
        <div class="loader ease-linear rounded-full border-8 border-t-8 border-gray-200 h-32 w-32"></div>
    </div>


    @if (count($courses) <= 0)
        <div class="flex justify-center items-center">
            <div class="p-10 text-center bg-white w-1/2 shadow rounded-md">
                <h2 class="text-xl font-bold text-gray-800">La búsqueda no arrojó ningún resultado</h2>
                <p class="pt-2 text-base text-indigo-500">Intenta con otros términos...</p>
            </div>
        </div>
    @endif

    <div class="mt-10"
         wire:loading.remove
    >
        {{ $courses->links() }}
    </div>

</div>

    <script>
        function onScrolling() {
            return {
                buttonVisible: false,
                toggleButton() {
                    const searchbarHeight = this.$refs.searchbar.clientHeight;
                    this.buttonVisible = this.$refs.searchbar.getBoundingClientRect().top <= searchbarHeight * -1;
                },
                top() {
                    window.scroll({
                        top: 0,
                        behavior: "smooth"
                    })
                }
            }
        }

    </script>


