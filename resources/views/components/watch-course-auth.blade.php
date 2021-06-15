@props([
    'course' => ''
])
@can('view', $course)
    <x-button class="text-sm px-8 rounded-full py-3 transition-colors duration-300" href="{{ $course->watchPath() }}">Continuar curso</x-button>
@else
    <x-form-button action="{{ route('courses.save', $course) }}" method="POST" class="py-2 px-4 shadow-md rounded-md bg-indigo-500 hover:bg-indigo-700 inline-block text-white text-sm px-8 rounded-full py-3 transition-colors duration-300">
        Tomar este curso
    </x-form-button>
@endcan
