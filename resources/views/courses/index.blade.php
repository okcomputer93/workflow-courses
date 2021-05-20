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

        @if(count($courses) === 0)
            <div class="py-12 flex justify-center items-center text-center text-gray-900">
                <div class="card bg-white p-16 shadow rounded-md">
                    <h3 class="font-bold text-3xl leading-snug max-w-md">¡Nuestros docentes están trabajando a la velocidad de la luz para ofrecerte cursos!</h3>
                    <h4 class="mt-4 font-light text-xl text-indigo-500">Parece que han tardado un poco</h4>
                    <img class="mt-8 m-auto block h-96" src="/images/confused-person.svg" alt="confused person">
                </div>
            </div>
        @endif

    </x-section>
</x-layout>
