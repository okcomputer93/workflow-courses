<x-layout>
    <x-slot name="head">
        <title>Workflow | {{ $course->title }}</title>
    </x-slot>
    <x-section type="base" class="py-20">
        <div class="py-10 bg-gradient-to-r from-indigo-500 to-category-{{ $course->category->id }} rounded-t-xl shadow-xl">
            <div class="flex justify-between items-center">
                <div class="flex-1 m-10">
                    <img class="w-2/3 rounded-xl m-auto"
                         src="{{ asset($course->miniature) }}"
                         alt="{{ $course->title .  "'s miniature" }}">
                </div>
                <div class="flex-1 flex flex-col justify-center">
                    <div class="w-2/3">
                        <h2 class="font-bold text-3xl text-white">{{ $course->title }}</h2>
                        <p class="mt-6 font-light text-base text-white">{{ $course->description }}</p>
                        <div class="mt-3">
                            <x-button href="#">Tomar este curso</x-button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="px-20 rounded-b-xl bg-category-{{ $course->category->id }}">
           <div class="flex items-center justify-between py-4">
               <div class="flex justify-center">
                   <div class="flex items-center justify-center space-x-0.5">
                       @for ($i = 1; $i <= 3; $i++)
                           <span class="rounded block {{ $i <= $course->level->scale ? 'bg-white' : 'bg-gray-500' }}"
                                 style="width: 7px; height: 11px"
                           ></span>
                       @endfor
                       <h4 class="pl-1 text-white font-bold text-xs uppercase">{{ $course->level->name }}</h4>
                   </div>
                   <a href="#"
                      class="ml-4 border border-white rounded-lg hover:text-category-{{ $course->category->id }} hover:bg-white block py-2 px-4 text-white font-bold text-xs uppercase"
                   >
                       {{ str_replace('_', ' ', $course->category->name) }}
                   </a>
               </div>
               <div class="flex justify-between items-center">
                   <p class="text-white text-xs pr-2">Rating: </p>
                   <x-rate :rate="$course->rate" max="5"></x-rate>
               </div>
           </div>
        </div>
        <div class="bg-gray-300 mt-20 pt-8 pb-12 w-2/3 mx-auto rounded-xl shadow">
            <div class="px-10 flex justify-between items-center">
               <div>
                   <h4 class="font-bold uppercase text-base text-gray-600"
                   >
                       Instructor |<span class="ml-1 font-light font-light text-category-{{ $course->category->id }}"
                       >
                           <a href="#">{{ $course->owner->name }}</a>
                       </span>
                   </h4>
                   <p class="font-light text-sm text-gray-500">Ingeniero de Software</p>
               </div>
                <div>
                    <a href="#">
                        <i class="fab fa-twitter fa-lg text-gray-400 px-1 hover:text-indigo-500"></i>
                    </a>
                    <a href="#">
                        <i class="fab fa-github-alt fa-lg text-gray-400 px-1 hover:text-indigo-500"></i>
                    </a>
                </div>
            </div>
            <div class="px-10 pt-4 flex justify-center items-center">
                <img class="inline-block w-24 h-24 rounded-full border-4 border-category-{{ $course->category->id }}"
                     src="https://laracasts.s3.amazonaws.com/avatars/jeffrey-avatar.jpg"
                     alt="{{ $course->owner->name . 'avatar' }}"
                >
                <div class="ml-6">
                    <span class="inline-block text-sm font-bold mb-3">Acerca de mi:</span>
                    <p class="text-sm font-light text-gray-700"
                    >
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Animi autem, distinctio esse id libero magni nam necessitatibus officia placeat repudiandae suscipit temporibus. Magni natus nemo nihil rem vitae? At, harum.
                    </p>
                </div>
            </div>
        </div>
    </x-section>
</x-layout>

