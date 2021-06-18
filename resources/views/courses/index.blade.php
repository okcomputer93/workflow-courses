<x-layout>
    @push('styles')
        <livewire:styles />
    @endpush
    @push('scripts')
        <livewire:scripts />
        <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js"></script>
    @endpush

    <x-slot name="head">
        <title>Workflow | Todos los cursos</title>
    </x-slot>

    <x-section type="base">

        @if($totalCourses <= 0)
            <div class="py-4 flex justify-center items-center text-center text-gray-900 md:py-12">
                <div class="card bg-white p-8 shadow rounded-md md:p-16">
                    <h3 class="font-bold text-xl leading-snug max-w-md md:text-3xl">¡Nuestros docentes están trabajando a la velocidad de la luz para ofrecerte cursos!</h3>
                    <h4 class="mt-4 font-light text-xl text-indigo-500">Parece que han tardado un poco...</h4>
                    <img class="mt-3 h-auto md:mt-8 md:h-96 md:mx-auto" src="/images/confused-person.svg" alt="confused person">
                </div>
            </div>
        @else
            <livewire:show-courses />
        @endif

    </x-section>

</x-layout>
