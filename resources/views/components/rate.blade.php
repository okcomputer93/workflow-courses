<div class="flex-1 flex">
    @for ($i = 1; $i <= $max; $i++)
        <div class="{{ $i <= $rate ? 'text-yellow-400' : 'text-gray-500'  }}">
            <x-icon.star></x-icon.star>
        </div>
    @endfor
</div>
