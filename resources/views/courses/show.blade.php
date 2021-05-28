<x-layout>
    <x-slot name="head">
        <title>Workflow | {{ $course->title }}</title>
    </x-slot>

    <section class="course-presentation">
        <div class="p-32">
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
                    <div class="flex justify-between items-center">
                        <x-button class="text-sm px-8 rounded-full py-3 transition-colors duration-300" href="#">Tomar este curso</x-button>
                        @can('update', $course)
                            <x-button class="bg-white" href="{{ $course->path() . '/edit' }}">Actualizar Información</x-button>
                        @endcan
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="bg-blue-dark rounded-t-3xl -mt-5 p-16">
        <div class="flex flex-col justify-center items-center">
            <p class="text-sm font-light text-gray-200">Información adicional</p>
            <h2 class="text-2xl font-extrabold text-white mb-10">Acerca de este profesor</h2>

            <div class="bg-white z-10">
                <div class="user-card p-10">
                    <div class="flex justify-between items-center">
                        <div class="w-1/3">
                            <img class="w-20 h-20 rounded-full"
                                 src="{{ asset($course->owner->avatar) }}"
                                 alt="{{ $course->owner->name . ' avatar' }}"
                            >
                        </div>
                        <div class="max-w-md">
                            <h3 class="text-2xl">
                                <a href="#">{{ $course->owner->name }}</a>
                            </h3>
                            <p class="font-bold text-sm text-gray-500">{{ $course->owner->role->career }}</p>
                            <p class="text-sm font-light text-gray-700 mt-3">
                                {{ $course->owner->role->about }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
{{--    <x-section type="base" class="py-20">--}}
{{--        <div class="py-10 bg-white rounded-t-xl shadow-md">--}}
{{--            <div class="flex justify-between items-center">--}}
{{--                <div class="flex-1 m-10">--}}
{{--                    <img class="w-2/5 rounded-xl m-auto h-auto"--}}
{{--                         src="{{ asset($course->miniature) }}"--}}
{{--                         alt="{{ $course->title .  "'s miniature" }}">--}}
{{--                </div>--}}
{{--                <div class="flex-1 flex flex-col justify-center">--}}
{{--                    <div class="w-2/3">--}}
{{--                        <h2 class="font-bold text-3xl text-white">{{ $course->title }}</h2>--}}
{{--                        <p class="mt-6 font-light text-base text-white">{{ $course->description }}</p>--}}
{{--                        <div class="mt-3 flex justify-between items-center">--}}
{{--                            <x-button href="#">Tomar este curso</x-button>--}}
{{--                            @can('update', $course)--}}
{{--                                <x-button class="bg-white" href="{{ $course->path() . '/edit' }}">Actualizar Información</x-button>--}}
{{--                            @endcan--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <div class="px-20 rounded-b-xl bg-category-{{ $course->category->id }}">--}}
{{--           <div class="flex items-center justify-between py-4">--}}
{{--               <div class="flex justify-center">--}}
{{--                   <div class="flex items-center justify-center space-x-0.5">--}}
{{--                       <x-level-icon level="{{ $course->level->scale }}"></x-level-icon>--}}
{{--                       <h4 class="pl-1 text-white font-bold text-xs">{{ ucwords($course->level->name) }}</h4>--}}
{{--                   </div>--}}
{{--                   <a href="#"--}}
{{--                      class="ml-4 border border-white rounded-lg hover:text-category-{{ $course->category->id }} hover:bg-white block py-2 px-4 text-white font-bold text-xs"--}}
{{--                   >--}}
{{--                       {{ ucwords(str_replace('_', ' ', $course->category->name)) }}--}}
{{--                   </a>--}}
{{--               </div>--}}
{{--               <div class="flex justify-between items-center">--}}
{{--                   <p class="text-white text-xs pr-2">Rating: </p>--}}
{{--                   <x-rate :rate="$course->rate" max="5"></x-rate>--}}
{{--               </div>--}}
{{--           </div>--}}
{{--        </div>--}}
{{--        <div class="relative bg-bg-boost bg-no-repeat bg-cover bg-indigo-300 mt-20 pt-8 pb-12 w-2/3 mx-auto rounded-xl shadow-md">--}}
{{--            <div class="px-10 pt-4 flex justify-between items-center">--}}
{{--                <img class="block w-24 h-24 rounded-full border-4 border-category-{{ $course->category->id }}"--}}
{{--                src="{{ asset($course->owner->avatar) }}"--}}
{{--                alt="{{ $course->owner->name . ' avatar' }}"--}}
{{--                >--}}
{{--               <div>--}}
{{--                   <h4 class="font-bold text-base text-black"--}}
{{--                   >--}}
{{--                       Instructor |<span class="ml-1 font-light font-light"--}}
{{--                       >--}}
{{--                           <a href="#">{{ $course->owner->name }}</a>--}}
{{--                       </span>--}}
{{--                   </h4>--}}
{{--                   <p class="font-bold text-sm text-gray-500">{{ $course->owner->role->career }}</p>--}}
{{--               </div>--}}
{{--            </div>--}}
{{--            <div class="px-10 pt-4">--}}
{{--                <span class="inline-block text-sm font-bold text-gray-800 mb-3">Acerca de mi:</span>--}}
{{--                <p class="text-sm font-light text-gray-700"--}}
{{--                >--}}
{{--                    {{ $course->owner->role->about }}--}}
{{--                </p>--}}
{{--            </div>--}}
{{--            <div class="flex justify-end pr-10 mt-4">--}}
{{--                <a href="{{ twitter_user($course->owner->role->twitter_user) }}">--}}
{{--                    <i class="fab fa-twitter fa-lg text-gray-500 px-1 hover:text-indigo-500"></i>--}}
{{--                </a>--}}
{{--                <a href="{{ github_user($course->owner->role->github_user) }}">--}}
{{--                    <i class="fab fa-github-alt fa-lg text-gray-500 px-1 hover:text-indigo-500"></i>--}}
{{--                </a>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </x-section>--}}
</x-layout>

