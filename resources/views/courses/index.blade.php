<x-layout>
    @push('styles')
        <livewire:styles />
    @endpush
    @push('scripts')
        <livewire:scripts />
    @endpush

    <x-slot name="head">
        <title>Workflow | Upload a Course</title>
    </x-slot>

    <x-section type="base">

        <livewire:show-courses />

    </x-section>

</x-layout>
