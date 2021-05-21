<div>
    <div class="mb-10 p-6 bg-white shadow-md rounded-lg">
        <div class="flex justify-between items-center w-3/5">
            <label class="sr-only" for="search">Buscar en los cursos</label>
            <input wire:model.debounce.300ms="search" type="text" id="search" name="search" autofocus placeholder="Busca por título, profesor...">

            <label class="sr-only" for="categories"></label>
            <select class="w-full bg-white px-3 py-2 border border-gray-300 rounded-md focus:outline-none text-gray-600 focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 focus:z-10 sm:text-base"
                    wire:model="category"
                    name="categories"
                    id="categories"
            >
                <option value=""
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

            <label class="sr-only" for="levels"></label>
            <select class="w-full bg-white px-3 py-2 border border-gray-300 rounded-md focus:outline-none text-gray-600 focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 focus:z-10 sm:text-base"
                    wire:model="level"
                    name="levels"
                    id="levels"
            >
                <option value=""
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
    </div>

    <div class="grid justify-items-center grid-rows-1 grid-flow-row grid-cols-3 gap-y-16">
        @foreach ($courses as $course)
            <x-card :data="$course"></x-card>
        @endforeach
    </div>

    @if(count($courses) === 0)
        <div class="py-12 flex justify-center items-center text-center text-gray-900">
            <div class="card bg-white p-16 shadow rounded-md">
                <h3 class="font-bold text-3xl leading-snug max-w-md">¡Nuestros docentes están trabajando a la velocidad de la luz para ofrecerte cursos!</h3>
                <h4 class="mt-4 font-light text-xl text-indigo-500">Parece que han tardado un poco...</h4>
                <img class="mt-8 m-auto block h-96" src="/images/confused-person.svg" alt="confused person">
            </div>
        </div>
    @endif
</div>
