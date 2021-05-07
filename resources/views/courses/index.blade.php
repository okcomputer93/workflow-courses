<x-layout>
    <x-slot name="head">
        <title>Workflow | Upload a Course</title>
    </x-slot>
    <x-section type="base">
        <div class="grid justify-items-center grid-rows-1 grid-flow-row grid-cols-3 gap-y-16">
            @foreach ($courses as $course)
                <x-card :data="$course"></x-card>
            @endforeach
        </div>
    </x-section>
</x-layout>
