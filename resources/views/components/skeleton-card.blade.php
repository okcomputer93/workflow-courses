@php
    $random = range(2, 6);
    shuffle($random);
@endphp


<div class="skeleton-card">
    <article class="max-w-xs bg-white border border-gray-300 rounded-md overflow-hidden">
        <div class="w-80 bg-gray-200 h-80" ></div>
        <div class="p-6 flex flex-col h-56 justify-between">
            <div class="mt-2 mb-1">
                <div class="flex items-center mb-1">
                    <div class="w-1/{{ $random[0] }} h-4 bg-gray-200"></div>
                    <div class="w-full mx-2 h-4 bg-gray-200"></div>
                </div>
                <div class="flex items-center">
                    <div class="w-1/{{ $random[1] }} h-4 bg-gray-200"></div>
                    <div class="w-1/{{ $random[2] }} mx-2 h-4 bg-gray-200"></div>
                </div>
            </div>
            <div class="flex items-center">
                <div class="w-1/{{ $random[3] }} h-3 bg-gray-200 my-2"></div>
                <div class="w-1/{{ $random[4] }} mx-1 h-3 bg-gray-200 my-2"></div>
            </div>
            <div class="w-1/3 h-4 bg-gray-200 my-2"></div>
            <div class="w-full h-2 bg-gray-200 my-2 py-5 rounded"></div>
        </div>
    </article>
</div>
