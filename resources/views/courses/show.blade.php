<x-layout>
    <x-slot name="head">
        <title>Workflow | {{ $course->title }}</title>
    </x-slot>
    <x-section type="base" class="py-20">
        <div class="py-10 bg-gradient-to-r from-indigo-500 to-category-{{ $course->category->id }} rounded-t-xl shadow-xl">
            <div class="flex justify-between items-center">
                <div class="flex-1 m-10">
                    <img class="w-2/3 rounded-xl m-auto" src="{{ asset($course->miniature) }}" alt="{{ $course->title .  "'s miniature" }}">
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
                   <a href="#" class="ml-4 border border-white rounded-lg hover:text-category-{{ $course->category->id }} hover:bg-white block py-2 px-4 text-white font-bold text-xs uppercase">{{ str_replace('_', ' ', $course->category->name) }}</a>
               </div>
               <div class="flex justify-between items-center">
                   <p class="text-white text-xs pr-2">Rating: </p>
                   <x-rate :rate="$course->rate" max="5"></x-rate>
               </div>
           </div>
        </div>
    </x-section>
</x-layout>

