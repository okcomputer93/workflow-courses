<x-layout>
    <x-slot name="head">
        <title>Workflow | Upload a Course</title>
    </x-slot>
    <x-section type="base">
        @foreach ($courses as $course)
            <h1>{{ $course->title }}</h1>
        @endforeach
    </x-section>
</x-layout>
