@props([
    'items' => [],
    'name' => '',
    'value' => ''
])
<div>
    <label class="sr-only" for="{{ $name }}"></label>
    <select required class="w-full bg-white px-3 py-2 border border-gray-300 rounded-md focus:outline-none text-gray-600 focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 focus:z-10 sm:text-base" name="{{ $name }}" id="{{ $name }}">
        <option value=""
                @if(!old($name) || !$value)
                    selected
                @endif
                disabled hidden>
            {{ $slot }}
        </option>
        @foreach ($items as $item)
            <option  class="text-gray-700 hover:bg-indigo-500"
                     @if(old($name) === (string)$item->id || $value == (string)$item->id )
                         selected
                     @endif
                     value="{{ $item->id }}"
            >
                {{ ucwords(str_replace('_', ' ', $item->name)) }}
            </option>
        @endforeach
    </select>
</div>
