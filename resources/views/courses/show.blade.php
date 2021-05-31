<x-layout>
    <x-slot name="head">
        <title>Workflow | {{ $course->title }}</title>
    </x-slot>

    <section class="course-presentation">
        <div class="p-32 mx-auto max-w-7xl px-6">
            <div class="flex justify-between items-center w-4/5 mx-auto">
                <img class="w-72 h-72 transform translate-x-1/4 shadow-xl"
                     src="{{ asset($course->miniature) }}"
                     alt="{{ $course->title .  "'s miniature" }}"
                >
                <div class="ml-32 flex flex-col justify-between items-start space-y-6">
                    <div class="flex justify-start items-center space-x-2">
                        <p class="flex-shrink-0 text-xs font-bold uppercase p-1 border border-category-{{ $course->category->id }} text-category-{{ $course->category->id }} rounded-lg"
                        >
                            {{ ucwords(str_replace('_', ' ', $course->category->name)) }}
                        </p>
                        <p class="flex-shrink-0 text-xs font-bold uppercase p-1 border border-level-{{ $course->level->id }} text-level-{{ $course->level->id }} rounded-lg"
                        >
                            {{ ucwords(str_replace('_', ' ', $course->level->name)) }}
                        </p>
                    </div>
                    <h2 class="font-bold text-4xl text-blue-dark mb-2">{{ $course->title }}</h2>
                    <div class="mb-2">
                        <x-rate :rate="$course->rate" max="5"></x-rate>
                    </div>
                    <p class="font-light text-sm text-gray-600 mb-3">{{ $course->description }}</p>
                    <div>
                        <p class="text-xs font-bold">Tópicos a tratar</p>
                        <div class="mt-4 grid justify-items-start grid-flow-row grid-cols-2 gap-y-2 gap-x-4 text-xs font-light">
                            <p>Consectetur</p>
                            <p>Lorem</p>
                            <p>Ipsum</p>
                            <p>Dolor</p>
                            <p>Sit Amet</p>
                        </div>
                    </div>
                    <div class="flex justify-between items-center">
                        <x-button class="text-sm px-8 rounded-full py-3 transition-colors duration-300" href="#">Tomar este curso</x-button>
                        @can('update', $course)
                            <x-button class="bg-white" href="{{ $course->path('edit')}}">Actualizar Información</x-button>
                        @endcan
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="bg-blue-dark rounded-t-3xl -mt-5 p-16 shadow-xl">
        <div class="flex flex-col justify-center items-center mx-auto max-w-7xl px-6">
            <p class="text-sm font-light text-gray-200">Información adicional</p>
            <h2 class="text-2xl font-extrabold text-white mb-10">Acerca de este profesor</h2>

            <div class="bg-white z-10 rounded overflow-hidden w-80">
                <div class="flex flex-col items-center">
                    <div class="relative w-full">
                        <img class="w-full h-42 object-cover user-card-image"
                             src="{{ asset($course->owner->avatar) }}"
                             alt="{{ $course->owner->name . ' avatar' }}"
                        >
                        <h3 class="font-bold absolute bottom-10 text-right w-3/5 right-0 text-white">
                            <a class="bg-blue-medium bg-opacity-75 px-4 text-4xl decoration-clone" href="#">{{ $course->owner->name }}</a>
                            <span class="font-light bg-blue-medium bg-opacity-75 px-2 py-0.5 uppercase text-xl text-white">{{ $course->owner->role->career }}</span>
                        </h3>
                    </div>
                    <div class="flex-1 p-4">
                        <hr>
                        <p class="text-base font-light text-center text-gray-500 my-6">
                        <p class="text-base font-light text-center text-gray-500 my-6">
                            {{ $course->owner->role->about }}
                        </p>
                        <hr>
                        <div class="flex justify-start mt-3">
                            <a href="{{ twitter_user($course->owner->role->twitter_user) }}">
                                <i class="fab fa-twitter fa-lg text-gray-500 hover:text-indigo-500 px-1"></i>
                            </a>
                            <a href="{{ github_user($course->owner->role->github_user) }}">
                                <i class="fab fa-github-alt fa-lg text-gray-500 hover:text-indigo-500 px-1"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="w-full mt-12">
                <h2 class="text-2xl font-extrabold text-white text-center">Estadísticas actuales</h2>
                <div class="flex justify-evenly items-center pt-12">
                    <div class="text-center">
                        <p class="text-4xl text-white font-bold">20</p>
                        <h3 class="text-xs text-gray-50 font-light">Cursos en total</h3>
                    </div>
                    <div class="text-center">
                        <p class="text-4xl text-white font-bold">120</p>
                        <h3 class="text-xs text-gray-50 font-light">Alumnos han tomado este curso</h3>
                    </div>
                    <div class="text-center">
                        <p class="text-4xl text-white font-bold">80%</p>
                        <h3 class="text-xs text-gray-50 font-light">Valoraciones positivas</h3>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="bg-gray-100 py-12">
        <div class="mx-auto max-w-7xl px-6">
            <div class="flex flex-col justify-center items-center">
                <div class="bg-indigo-500 inline-block rounded-md p-2 mb-4 text-white">
                    <x-icon.lighting-bolt></x-icon.lighting-bolt>
                </div>
                <h3 class="text-3xl font-extrabold text-gray-900 max-w-xl text-center">Listo para comenzar a mejorar tus habilidades con este curso?</h3>
                <span class="h-1 w-1/12 bg-indigo-500 my-1"></span>
                <x-button class="text-sm px-8 rounded-full py-3 mt-5 transition-colors duration-300" href="#">Tomar este curso</x-button>
            </div>
        </div>
    </section>
</x-layout>

