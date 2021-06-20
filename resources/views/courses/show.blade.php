<x-layout>
    <x-slot name="head">
        <title>Workflow | {{ $course->title }}</title>
    </x-slot>
    @push('scripts')
        <script src="{{ asset('js/comments.js') }}"></script>
    @endpush
    <div id="app">
        <x-section type="transparent" id="course-presentation" class="course-presentation">
            <div class="py-10 flex flex-col justify-center items-center w-full md:py-20">
                <div class="flex flex-col justify-center items-center w-full md:justify-between md:flex-row xl:w-4/5">
                    <img class="transform shadow-xl w-52 h-52 md:w-72 md:h-72 xl:translate-x-1/4"
                         src="{{ asset($course->miniature) }}"
                         alt="{{ $course->title .  "'s miniature" }}"
                    >
                    <div class="ml-0 mt-10 flex flex-col justify-center items-center space-y-3 bg-white md:justify-between rounded-md border border-gray-300 p-6 md:p-0 md:border-transparent w-full sm:w-80 md:w-full md:items-start md:space-y-6 md:ml-16 xl:ml-32 md:mt-0 md:bg-transparent">
                        <div class="flex justify-between w-full items-center space-x-1 md:justify-start md:space-x-2">
                            <p class="flex-shrink-0 text-xs font-light p-1 border border-category-{{ $course->category->id }} text-category-{{ $course->category->id }} rounded-lg md:font-bold md:uppercase"
                            >
                                {{ ucwords(str_replace('_', ' ', $course->category->name)) }}
                            </p>
                            <p class="flex-shrink-0 text-xs font-light p-1 border border-level-{{ $course->level->id }} text-level-{{ $course->level->id }} rounded-lg md:font-bold md:uppercase"
                            >
                                {{ ucwords(str_replace('_', ' ', $course->level->name)) }}
                            </p>
                        </div>
                        <h2 class="font-bold text-2xl text-blue-dark mb-2 text-center md:text-left md:text-4xl">{{ $course->title }}</h2>
                        <div class="mb-2">
                            <x-rate :rate="$course->rate" max="5"></x-rate>
                        </div>
                        <p class="font-light text-sm text-gray-600 mb-3 break-all">{{ $course->description }}</p>
                        <div>
                            <h4 class="text-base font-bold text-center md:text-left">Tópicos a tratar</h4>
                            <div class="mt-2 grid justify-items-center grid-flow-row grid-cols-2 gap-y-2 gap-x-4 text-xs font-light md:justify-items-start md:grid-cols-4 md:mt-4">
                                <p>Consectetur</p>
                                <p>Lorem</p>
                                <p>Ipsum</p>
                                <p>Dolor</p>
                                <p>Sit Amet</p>
                            </div>
                        </div>
                        <div class="flex justify-between items-center">
                            <x-watch-course-auth :course="$course"></x-watch-course-auth>
                            @can('update', $course)
                                <x-button class="bg-white" href="{{ $course->path('edit')}}">Actualizar Información</x-button>
                            @endcan
                        </div>
                    </div>
                </div>
            </div>
        </x-section>


        <section class="bg-blue-dark rounded-t-3xl -mt-5 px-0 py-8 md:p-16">
            <div class="flex flex-col justify-center items-center mx-auto max-w-7xl px-6">
                <p class="text-sm font-light text-gray-200">Información adicional</p>
                <h2 class="text-3xl mt-2 text-center font-extrabold text-white mb-10 md:mt-0">Acerca de este profesor</h2>

                <div class="bg-white rounded overflow-hidden w-72 md:w-80">
                    <div class="flex flex-col items-center">
                        <div class="relative w-full">
                            <img class="w-full h-42 object-cover user-card-image"
                                 src="{{ asset($course->owner->avatar) }}"
                                 alt="{{ $course->owner->name . ' avatar' }}"
                            >
                            <h3 class="font-bold absolute bottom-10 text-right w-3/5 right-0 text-white mr-1 md:w-4/5">
                                <a href="#">
                                    <span class="text-xl bg-blue-medium bg-opacity-50 decoration-clone md:text-4xl"
                                    >
                                    {{ $course->owner->name }}
                                </span>
                                    <span class="bg-blue-medium bg-opacity-50 font-bold uppercase px-2 relative right-0 text-sm md:text-base"
                                    >
                                    {{ $course->owner->role->career }}
                                </span>
                                </a>
                            </h3>
                        </div>
                        <div class="flex-1 p-4">
                            <hr>
                            <p class="text-base font-light text-center text-gray-500 my-6 break-words">
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
                    <div class="flex flex-col justify-center items-center pt-4 space-y-6 md:space-y-0 md:pt-12 md:flex-row md:justify-evenly">
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

        <comments-section :course-id="{{ $course->id }}"></comments-section>

        <section class="bg-gray-100 py-12">
            <div class="mx-auto max-w-7xl px-6">
                <div class="flex flex-col justify-center items-center">
                    <div class="bg-indigo-500 inline-block rounded-md p-2 mb-4 text-white">
                        <x-icon.lighting-bolt></x-icon.lighting-bolt>
                    </div>
                    <h3 class="text-3xl font-extrabold text-gray-900 max-w-xl text-center">Listo para comenzar a mejorar tus habilidades con este curso?</h3>
                    <span class="h-1 w-1/12 bg-indigo-500 my-1"></span>
                   <div class="mt-5">
                       <x-watch-course-auth :course="$course"></x-watch-course-auth>
                   </div>
                </div>
            </div>
        </section>


        @auth
            <add-comment can-comment="{{ Auth::user()->can('create', [\App\Models\Comment::class, $course]) }}"
                         :course-id="{{ $course->id }}"
            ></add-comment>
        @endauth
        <scroll to="course-presentation"></scroll>
    </div>

</x-layout>
