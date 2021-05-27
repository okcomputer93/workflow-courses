@props([
    'level' => 0
])

<div class="flex justify-center items-center space-x-0.5">
    @for ($i = 1; $i <= 3; $i++)
        <span class="rounded block {{ $i <= $level ? 'bg-white' : 'bg-gray-500' }}"
              style="width: 7px; height: 11px"
        ></span>
    @endfor
</div>

