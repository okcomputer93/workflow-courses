<x-layout>
    <x-slot name="head">
        <title>Workflow | Viendo {{ $course->title }}</title>
    </x-slot>

    <x-section type="base">
        <div class="w-full flex justify-center items-center flex-col py-4">
            <h1 class="text-2xl font-bold text-center md:text-4xl">{{ $course->title }}</h1>
            <video class="w-full h-72 mt-10 md:w-5/6 md:h-full" src="{{ $course->video_url }}" controls></video>
        </div>
    </x-section>

</x-layout>
